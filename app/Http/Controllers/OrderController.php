<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryDistributor;
use App\Classes\Cart;
use App\Models\CreditCard;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RetailerShop;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    //
    public function index()
    {
        $result = InventoryDistributor::with('distributor', 'medicine')->get();
        // $data = DistributorShop::with('inventories.medicine')->select('DistributorShopId' ,'DistributorShopName')->get();
        return view('testingViews.order')->with('data', $result);
    }

    public function create()
    {
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

        $cart = new Cart();
        $cartData = $cart->getCart();

        //Grouping on based of Distributors
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
        $retailerId = RetailerShop::select('RetailerShopId')->where('UserId','=',Auth::id())->first()->RetailerShopId;
        $orderRecord = Order::with('orderitems', 'distributor:DistributorShopId,DistributorShopName', 'orderitems.medicine')->where('RetailerId','=', $retailerId)->orderBy('OrderId', 'desc')->get();
        // return $orderRecord;
        return view('testingViews.orderhistory')->with('orders', $orderRecord);

    }
}

?>
