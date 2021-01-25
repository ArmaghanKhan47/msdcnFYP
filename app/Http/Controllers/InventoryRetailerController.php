<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RetailerShop;
use Illuminate\Support\Facades\Auth;

class InventoryRetailerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retailerInfo = RetailerShop::with('inventories','inventories.medicine')->where('UserId', Auth::id())->first();
        // return $retailerInfo;
        return view('inventory',compact('retailerInfo'));
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
            $query->where('MedicineId', $id);
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
