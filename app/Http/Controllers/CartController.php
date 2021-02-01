<?php

namespace App\Http\Controllers;

use App\Classes\Cart;
use App\Models\DistributorShop;
use App\Models\Medicine;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create cart object
        $cart = new Cart();
        $cartData = $cart->getCart();
        $newCart = collect();
        $count = 1;
        foreach($cartData as $item)
        {
            $newItem = collect();
            $newItem->put('medicine', (object)Medicine::select(['MedicineName', 'MedicineCompany', 'MedicineType'])->find($item->get('medicineid')));
            $newItem->put('distributor', (object)DistributorShop::select('DistributorShopName')->find($item->get('distributorid')));
            $newItem->put('unitprice', $item->get('unitprice'));
            $newItem->put('totalprice', $item->get('totalprice'));
            $newItem->put('quantity', $item->get('quantity'));
            $newCart->put($count, $newItem);
            $count = $count + 1;
        }
        return view('cart.cart')->with('cart', $newCart);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'medicineid' => 'required|string',
            'distributorid' => 'required|string',
            'quantity' => 'required|string',
            'unitprice' => 'required|string',
            'totalprice' => 'required|string'
        ]);

        $cart = new Cart();
        $cart->addItem(collect([
            'medicineid' => $request->input('medicineid'),
            'distributorid' => $request->input('distributorid'),
            'unitprice' => $request->input('unitprice'),
            'totalprice' => $request->input('totalprice'),
            'quantity' => $request->input('quantity')
        ]));

        return redirect(url()->previous())->with('success', 'Item added to cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
