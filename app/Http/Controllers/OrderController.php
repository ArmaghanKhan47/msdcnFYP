<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryDistributor;
use App\Classes\Cart;
use App\Models\CreditCard;
use App\Models\DistributorShop;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RetailerShop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class OrderController extends Controller
{
    private static $paymentMethods = ['COD', 'Credit Card'];
    //
    public function index()
    {
        //Show Medicine to Retailer, avalible to Buy
        $result = InventoryDistributor::with(['distributor' => function($query){
            $query->where('Region', session('region'));
        }, 'medicine'])->get();
        $result = $result->map(function($item, $key){
            if ($item->distributor != null)
            {
                return $item;
            }
        });
        // $data = DistributorShop::with('inventories.medicine')->select('DistributorShopId' ,'DistributorShopName')->get();
        return view('testingViews.order')->with('data', $result);
    }

    public function create()
    {
        //Show Cart Checkout View to Retailer
        $cart = new Cart();
        $cartData = $cart->getCart();
        $retailerData = RetailerShop::select('RetailerShopId', 'shopAddress')->where('UserId','=', Auth::id())->first();
        $creditCard = CreditCard::find(Auth::user()->CreditCardId);
        return view('cart.cartcheckout')->with('data', [$cartData, $retailerData, $creditCard]);
    }

    public function store(Request $request)
    {
        //Storing Order Details in Database
        $this->validate($request, [
            'retailerid' => 'string|required',
            'shippingAddress' => 'string|required',
            'paymentMethod' => 'numeric|required|min:0|max:1'
        ]);

        $paymentStatus = 'Unpayed';

        //Check if Retailer has an address if not save given address
        $retailerData = RetailerShop::select('RetailerShopId', 'shopAddress')->where('UserId','=', Auth::id())->first();
        if($retailerData->shopAddress == null)
        {
            // $retailer = RetailerShop::select('RetailerShopId', 'shopAddress')->where('UserId','=', Auth::id())->first();
            $retailerData->shopAddress = $request->input('shippingAddress');
            $retailerData->save();
        }

        //This will check if user has credit card
        if ($request->input('paymentMethod'))
        {
            //If value of paymentMethod is 1, which means Credit Card payment method is selected
            $test = new CreditCardController();
            $cardid = $test->create($request);
            if ($cardid != null)
            {
                //Means no credit card was found
                //New Credit Card Record is created and now the reference is being stored in user
                $user = User::find(Auth::id());
                $user->CreditCardId = $cardid;
                $user->save();
            }

            $paymentStatus = 'Payed';
        }

        $cart = new Cart();
        $cartData = $cart->getCart();

        //Grouping on based of Distributors and orders are made on base of Distributors
        //For Example if cart has items from 3 different Distributor, So 3 orders will be created.
        $cartNew = $cartData->mapToGroups(function($item, $key){
            return [$item['distributorid'] => $item];
        });
        foreach($cartNew as $distributor)
        {
            //create Order
            $orderid = Order::create([
                'RetailerId' => $request->input('retailerid'),
                'DistributorId' => $distributor[0]->get('distributorid'),
                'OrderStatus' => 'Pending|' . $paymentStatus,
                'PaymentMethod' => OrderController::$paymentMethods[$request->input('paymentMethod')],
                'PayableAmount' => $distributor->sum('totalprice'),
                'PayedDate' => date('y-m-d'),
                'OrderPlacingDate' => date('y-m-d'),
                'deliveryAddress' => $request->input('shippingAddress'),
            ])->OrderId;
            foreach($distributor as $item)
            {
                //Create Order Items
                OrderItem::create([
                    'OrderId' => $orderid,
                    'MedicineId' => $item->get('medicineid'),
                    'Quantity' => $item->get('quantity'),
                    'Subtotal' => $item->get('totalprice')
                ]);
            }
        }
        //Delete the cart as the order is placed
        $request->session()->forget('cart');
        return redirect('/home')->with('success', 'Your Order Has been Placed');
    }

    public function show()
    {
        //Reterive Order History based on $id and order by placing date
        if (Auth::user()->UserType == 'Retailer')
        {
            $retailerId = RetailerShop::select('RetailerShopId')->where('UserId','=',Auth::id())->first()->RetailerShopId;
            $orderRecord = Order::with('orderitems', 'distributor:DistributorShopId,DistributorShopName', 'orderitems.medicine:MedicineId,MedicineName,MedicineType')->where('RetailerId','=', $retailerId)->orderBy('OrderId', 'desc')->get();
            // return $orderRecord;
            return view('testingViews.orderhistory')->with('orders', $orderRecord);
        }
        else if(Auth::user()->UserType == 'Distributor')
        {
            $distributorId = DistributorShop::select('DistributorShopId')->where('UserId','=',Auth::id())->first()->DistributorShopId;
            $orderRecord = Order::with('orderitems', 'retailer:RetailerShopId,RetailerShopName', 'orderitems.medicine:MedicineId,MedicineName,MedicineType')->where('DistributorId','=', $distributorId)->orderBy('OrderId', 'desc')->get();
            // return $orderRecord;
            return view('testingViews.orderhistory')->with('orders', $orderRecord);
        }
    }

    public function update(Request $request)
    {
        //For Distributor to Change Order Status
        $this->validate($request, [
            'orderid' => 'string|required',
            'status' => 'numeric|required|min:0|max:3'
        ]);

        $order = Order::find($request->input('orderid'));
        switch($request->input('status'))
        {
            /*
                0 => accepted
                1 => cancelled
                2 => dispatched
                3 => completed
            */
            case 0:
                $order->OrderStatus = str_replace('Pending', 'Preparing', $order->OrderStatus);
                $order->save();
                return redirect('/order/history')->with('success', 'Order#' . $request->input('orderid') . ' Accepted');
                break;

            case 1:
                $order->OrderStatus = str_replace('Pending', 'Cancelled', $order->OrderStatus);
                $order->OrderCompletionDate = date('Y-m-d');
                $order->save();
                return redirect('/order/history')->with('error', 'Order#' . $request->input('orderid') . ' Cancelled');
                break;

            case 2:
                $order->OrderStatus = str_replace('Preparing', 'Dispatched', $order->OrderStatus);
                $order->save();
                return redirect('/order/history')->with('success', 'Order#' . $request->input('orderid') . ' Marked as Dispatched');
                break;

            case 3:
                $order->OrderStatus = str_replace('Dispatched', 'Completed', $order->OrderStatus);
                $order->OrderCompletionDate = date('Y-m-d');
                $order->save();
                return redirect('/order/history')->with('success', 'Order#' . $request->input('orderid') . ' Marked as Completed');
                break;
        }
    }
}

?>
