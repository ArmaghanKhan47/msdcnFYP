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
    //
    public function index()
    {
        //Show Medicine to Retailer, avalible to Buy
        $result = InventoryDistributor::with('distributor', 'medicine')->get();
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
            'shippingAddress' => 'string|required'
        ]);

        //Check if Retailer has an address if not save given address
        $retailerData = RetailerShop::select('RetailerShopId', 'shopAddress')->where('UserId','=', Auth::id())->first()->shopAddress;
        if($retailerData == null)
        {
            $retailer = RetailerShop::select('RetailerShopId', 'shopAddress')->where('UserId','=', Auth::id())->first();
            $retailer->shopAddress = $request->input('shippingAddress');
            $retailer->save();
        }

        //This will check if user has credit card
        $test = new CreditCardController();
        $cardid = $test->create($request);
        if ($cardid != null)
        {
            $user = User::find(Auth::id());
            $user->CreditCardId = $cardid;
            $user->save();
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
                'OrderStatus' => 'Pending|Payed',
                'PaymentMethod' => 'CreditCard',
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
            'status' => 'string|required'
        ]);

        $order = Order::find($request->input('orderid'));
        switch($request->input('status'))
        {
            case 'accepted':
                $order->OrderStatus = str_replace('Pending', 'Preparing', $order->OrderStatus);
                $order->save();
                return redirect('/order/history')->with('success', 'Order Accepted');
                break;

            case 'cancelled':
                $order->OrderStatus = str_replace('Pending', 'Cancelled', $order->OrderStatus);
                $order->save();
                return redirect('/order/history')->with('error', 'Order Cancelled');
                break;

            case 'dispatched':
                $order->OrderStatus = str_replace('Preparing', 'Dispatched', $order->OrderStatus);
                $order->save();
                return redirect('/order/history')->with('success', 'Order Marked as Dispatched');
                break;

            case 'completed':
                $order->OrderStatus = str_replace('Dispatched', 'Completed', $order->OrderStatus);
                $order->save();
                return redirect('/order/history')->with('success', 'Order Marked as Completed');
                break;
        }
    }
}

?>
