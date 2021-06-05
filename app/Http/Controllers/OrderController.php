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
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    private static $paymentMethods = ['COD', 'Credit Card', 'Mobile Payment'];
    //
    public function index()
    {
        Gate::authorize('retailerAccessOnly');
        //Show Medicine to Retailer, avalible to Buy
        $result = InventoryDistributor::with(['distributor' => function($query){
            $query->where('Region', session('region'));
        }, 'medicine'])->get();
        $result = $result->filter(function($item){
            if ($item->distributor != null)
            {
                return $item;
            }
        });
        return view('testingViews.order')->with('data', $result);
    }

    public function create()
    {
        Gate::authorize('retailerAccessOnly');
        //Show Cart Checkout View to Retailer
        $cart = new Cart();
        $cartData = $cart->getCart();
        $retailerData = RetailerShop::select('RetailerShopId', 'shopAddress')->where('UserId','=', Auth::id())->first();
        $creditCard = CreditCard::find(Auth::user()->CreditCardId);

        $distributors = $cartData->groupBy('distributorid')->map(function($item){
            return $item->sum('totalprice');
        });
        $mobilebanks = DistributorShop::select(['DistributorShopId', 'UserId', 'DistributorShopName'])->with(['user' => function($query){
            $query->select(['id', 'mobilebankaccountid'])->with('mobilebank');
        }])->whereIn('DistributorShopId', $distributors->keys())->get()->map(function($item) use ($distributors){
            // return $item->user->mobilebank;
            return (object)[
                'distributorshopid' => $item->DistributorShopId,
                'distributorshopname' => $item->DistributorShopName,
                'amount' => $distributors[$item->DistributorShopId],
                'mobilebank' => $item->user->mobilebank
            ];
        });
        return view('cart.cartcheckout')->with('data', [$cartData, $retailerData, $creditCard, $mobilebanks]);
    }

    public function store(Request $request)
    {
        Gate::authorize('retailerAccessOnly');
        //Storing Order Details in Database
        $this->validate($request, [
            'retailerid' => 'string|required',
            'shippingAddress' => 'string|required',
            'paymentMethod' => 'numeric|required|min:0|max:2'
        ]);

        $trasaction_ids = null;
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
        switch($request->input('paymentMethod'))
        {
            case 1:
                //Payment Mode Credit Card Selected
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
                break;

            case 2:
                //Payment mode Mobile Payment Selected
                $this->validate($request, [
                    'transactions-ids' => 'string|required'
                ]);
                $trasaction_ids = json_decode($request->input('transactions-ids'), true);
                foreach($trasaction_ids as $key => $value)
                {
                    //Validating the data
                    if (is_numeric($key) && is_numeric($value))
                    {
                        continue;
                    }
                    return redirect()->back()->with('error', 'Invalid Transaction Ids');
                }
                break;

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
                'TransactionId' => $trasaction_ids ? $trasaction_ids[$distributor[0]->get('distributorid')] : 000000000000
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
            $orderRecord = RetailerShop::select('RetailerShopId')->with(['orders' => function($query){
                $query->with('orderitems', 'distributor:DistributorShopId,DistributorShopName', 'orderitems.medicine:MedicineId,MedicineName,MedicineType', 'retailer:RetailerShopId')->orderBy('OrderId', 'desc')->get();
            }])->where('UserId', Auth::id())->first()->orders;
            // return $orderRecord;
            return view('testingViews.orderhistory')->with('orders', $orderRecord);
        }
        else if(Auth::user()->UserType == 'Distributor')
        {
            $orderRecord = DistributorShop::select('DistributorShopId')->with(['orders' => function($query){
                $query->with('orderitems', 'retailer:RetailerShopId,RetailerShopName', 'orderitems.medicine:MedicineId,MedicineName,MedicineType', 'distributor:DistributorShopId')->orderBy('OrderId', 'desc')->get();
            }])->where('UserId', Auth::id())->first()->orders;
            return view('testingViews.orderhistory')->with('orders', $orderRecord);
        }
    }

    public function update(Request $request)
    {
        //Distributor Only
        Gate::authorize('distributorAccessOnly');
        //For Distributor to Change Order Status
        $this->validate($request, [
            'orderid' => 'string|required',
            'status' => 'numeric|required|min:0|max:4'
        ]);

        $order = Order::find($request->input('orderid'));
        switch($request->input('status'))
        {
            /*
                0 => accepted
                1 => cancelled
                2 => dispatched
                3 => completed
                4 => payment status
            */
            case 0:
                //Order is accepted, changing status from Pending -> Preparing
                $order->OrderStatus = str_replace('Pending', 'Preparing', $order->OrderStatus);
                $order->save();
                return redirect('/order/history')->with('success', 'Order#' . $request->input('orderid') . ' Accepted');
                break;

            case 1:
                //Order is cancelled, changing status from Pending -> Cancelled
                $order->OrderStatus = str_replace('Pending', 'Cancelled', $order->OrderStatus);
                $order->OrderCompletionDate = date('Y-m-d');
                $order->save();
                return redirect('/order/history')->with('error', 'Order#' . $request->input('orderid') . ' Cancelled');
                break;

            case 2:
                //Order is dispatched, changing status from Preparing -> Dispatched
                $order->OrderStatus = str_replace('Preparing', 'Dispatched', $order->OrderStatus);
                $order->save();
                return redirect('/order/history')->with('success', 'Order#' . $request->input('orderid') . ' Marked as Dispatched');
                break;

            case 3:
                //Order is completed, changing status from Dispatched -> Completed
                $order->OrderStatus = str_replace('Dispatched', 'Completed', $order->OrderStatus);
                $order->OrderCompletionDate = date('Y-m-d');
                $order->save();
                return redirect('/order/history')->with('success', 'Order#' . $request->input('orderid') . ' Marked as Completed');
                break;

            case 4:
                //Order payment is made, changing payment status from Unpayed -> Payed
                $order->OrderStatus = str_replace('Unpayed', 'Payed', $order->OrderStatus);
                $order->save();
                return redirect('/order/history')->with('success', 'Order#' . $request->input('orderid') . ' Marked as Payed');
                break;
        }
    }

    public function quickOrder($medicineName)
    {
        Gate::authorize('retailerAccessOnly');

        $result = InventoryDistributor::with(['distributor' => function($query){
            $query->where('Region', session('region'));
        }, 'medicine' => function($query) use ($medicineName){
            $query->where('MedicineName', 'LIKE', '%' . $medicineName . '%');
        }])->get();
        $result = $result->filter(function($item){
            if ($item->distributor != null && $item->medicine != null)
            {
                return $item;
            }
        });
        return view('testingViews.order')->with('data', $result);
    }
}

?>
