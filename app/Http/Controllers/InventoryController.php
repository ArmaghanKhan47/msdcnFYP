<?php

namespace App\Http\Controllers;

use App\Models\DistributorShop;
use App\Models\InventoryRetailer;
use Illuminate\Http\Request;
use App\Models\RetailerShop;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = null;
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $info = RetailerShop::with('inventories','inventories.medicine')->select('RetailerShopId')->where('UserId', Auth::id())->first();
                break;
            case 'Distributor':
                $info = DistributorShop::with('inventories', 'inventories.medicine')->select('DistributorShopId')->where('UserId', Auth::id())->first();
                break;
        }
        // return $info;
        return view('inventory',compact('info'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = RetailerShop::select('RetailerShopId')->with(['inventories' => function($query) use ($id){
            $query->where('InventoryId', $id);
        },'inventories.medicine'])->where('UserId', Auth::id())->first();
        return view('testingViews.inventoryedit')->with('data', $data);
        return $data;
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
        $this->validate($request, [
            'quantity' => 'required',
            'unitprice' => 'required'
        ]);

        $record = InventoryRetailer::find($id);
        $record->quantity = $request->input('quantity');
        $record->unitprice = $request->input('unitprice');
        $record->save();

        return redirect('/inventory')->with('success', 'Inventory Updated');
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