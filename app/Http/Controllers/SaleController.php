<?php

namespace App\Http\Controllers;

use App\Models\InventoryRetailer;
use App\Models\Medicine;
use App\Models\PointOfSaleRetailerRecord;
use App\Models\RetailerShop;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = RetailerShop::with(['pointofsale' => function($query){
            $query->where('created_at', 'LIKE', date('Y-m-d').'%');
        }, 'pointofsale.sales' => function($query){
            $query->orderBy('updated_at', 'desc');
        }])->where('UserId', Auth::id())->first()->pointofsale[0]->sales;

        $yesterday = RetailerShop::with(['pointofsale' => function($query){
            $query->where('created_at', 'LIKE', date('Y-m-d', strtotime('yesterday')).'%');
        }, 'pointofsale.sales' => function($query){
            $query->orderBy('updated_at', 'desc');
        }])->where('UserId', Auth::id())->first()->pointofsale[0]->sales->sum('Payed');
        return view('sales.index', compact('sales', 'yesterday'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.newsale');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'total' => 'numeric|required',
            'discount' => 'numeric|required',
            'grandtotal' => 'numeric|required',
            'medicine' => 'string|required',
        ]);

        $retailerId = RetailerShop::select('RetailerShopId')->where('UserId', Auth::id())->first()->RetailerShopId;
        //Step:1 Find or Create a record in PointOfSale Table
        $pos = PointOfSaleRetailerRecord::where('RetailerShopId', $retailerId)->where('created_at', 'LIKE', date('Y-m-d').'%')->firstOr(function() use ($retailerId){
            //Create New Point Of Sale
            return PointOfSaleRetailerRecord::create([
                'RetailerShopId' => $retailerId,
                'DailyRevenue' => 0
            ]);
        });
        //Step:2 Check and Update Inventory Items in Inventory
        foreach(json_decode($request->input('medicine')) as $medicine)
        {
            $inventoryId = $medicine->inventoryid;
            $inventory = InventoryRetailer::where('InventoryId', $inventoryId)->first();
            if ($inventory->Quantity < $medicine->quantity)
            {
                //Retailer is short of stock to server
                $medicinename = Medicine::select('MedicineName')->where('MedicineId', $medicine->medicineid)->first()->MedicineName;
                return redirect()->back()->with('error', 'You are out of stock, for medicine ' . $medicinename . ' is ' . $inventory->Quantity);
            }
            //Update Inventory Values
            $inventory->Quantity -= $medicine->quantity;
            $inventory->save();
        }
        //Step:3.1 Create New Sale in the Sale Table
        $sale = Sale::create([
            'PointOfSaleId' => $pos->RecordId,
            'Total' => $request->input('total'),
            'Discount' => $request->input('discount'),
            'Payed' => $request->input('grandtotal')
        ]);
        //Step:3.2 Update DailyRevenue in POS
        $pos->DailyRevenue += $request->input('grandtotal');
        $pos->save();
        //Step:4 Create New Sale Items in the Sale Items Table, and get Medicine ID form Inventory
        foreach(json_decode($request->input('medicine')) as $medicine)
        {
            SaleItem::create([
                'SaleId' => $sale->SaleId,
                'MedicineId' => $medicine->medicineid,
                'Quantity' => $medicine->quantity,
                'SubTotal' => $medicine->subtotal
            ]);
        }
        return redirect(route('sales.index'))->with('success', 'Sales Created');
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
