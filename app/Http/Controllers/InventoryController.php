<?php

namespace App\Http\Controllers;

use App\Models\DistributorShop;
use App\Models\InventoryDistributor;
use App\Models\InventoryRetailer;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\RetailerShop;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('userable.inventories.medicine')->find(Auth::id());
        // return $info;
        return view('inventory',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $medicines = Medicine::select(
            'MedicineId',
            'MedicineName',
            'MedicineType',
            'MedicineCompany',
            'MedicineFormula')
            ->orderBy('MedicineCompany', 'asc')->get()
            ->mapToGroups(function($item, $key){
                return [$item->MedicineCompany => $item];
            });
        return view('testingViews.inventoryadd')->with('medicines', $medicines);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Store New
        $this->validate($request, [
            'medicine_list' => 'string|required'
        ]);

        $medicine_list = json_decode($request->input('medicine_list'));

        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $retailershopid = RetailerShop::select('RetailerShopId')
                ->where('UserId', '=', Auth::id())->first()->RetailerShopId;
                foreach($medicine_list as $key => $value)
                {
                    //Check for ensuring the data type of variables
                    if ((!is_numeric($value[0]) || (integer)$value[0] < 0) && (!is_numeric($value[1]) != 'double' || (double)$value[1] < 0))
                    {
                        // return '<h1>If Statment</h1><br><span>0 is_numeric: '. is_numeric($value[0]) .'</span><br><span>0 gettype: '. gettype($value[0]) .'</span><br><span>0 value: '. $value[0] .'</span><br><span>1 is_numeric: '. is_numeric($value[1]) .'</span><br><span>1 gettype: '. gettype($value[1]) .'</span><br><span>1 value: '. $value[1] .'</span>';
                        return redirect()->back()->with('error', 'Invalid Values Entered');
                    }

                    $record = InventoryRetailer::where('RetailerShopId', $retailershopid)
                    ->where('MedicineId', $key)->first();
                    if ($record)
                    {
                        //Medicine exist in inventory
                        $record->Quantity += $value[0];
                        $record->UnitPrice = ($value[1] == 0) ? ($record->UnitPrice) : ($value[1]);
                        $record->save();
                    }
                    else
                    {
                        //Medicine does not exist in inventory
                        InventoryRetailer::create([
                            'RetailerShopId' => $retailershopid,
                            'MedicineId' => $key,
                            'Quantity' => $value[0],
                            'UnitPrice' => $value[1]
                        ]);
                    }
                }
                break;
            case 'Distributor':
                $distributorshop = DistributorShop::select(['DistributorShopId', 'Region'])
                ->where('UserId', '=', Auth::id())->first();
                foreach($medicine_list as $key => $value)
                {
                    //Check for ensuring the data type of variables
                    if ((!is_numeric($value[0]) || (integer)$value[0] < 0) && (!is_numeric($value[1]) != 'double' || (double)$value[1] < 0))
                    {
                        // return '<h1>If Statment</h1><br><span>0 is_numeric: '. is_numeric($value[0]) .'</span><br><span>0 gettype: '. gettype($value[0]) .'</span><br><span>0 value: '. $value[0] .'</span><br><span>1 is_numeric: '. is_numeric($value[1]) .'</span><br><span>1 gettype: '. gettype($value[1]) .'</span><br><span>1 value: '. $value[1] .'</span>';
                        return redirect()->back()->with('error', 'Invalid Values Entered');
                    }

                    //Check if this medicine is being sold by other distributor or not
                    //In Same Region only one distributor can sell particular medicine, different distributors in same region cannot sell same medicine
                    $otherDistributorsRecord = DistributorShop::select(
                        'DistributorShopId',
                        'Region',
                        'UserId')
                        ->with(['inventories' => function($query) use ($key){
                            $query->where('MedicineId', $key);
                        }])->where('Region', $distributorshop->Region)
                        ->where('UserId', '!=', Auth::id())->get();

                    foreach($otherDistributorsRecord as $dist)
                    {
                        foreach($dist->inventories as $invent)
                        {
                            if ($invent->MedicineId == $key)
                            {
                                return redirect()->back()->with('error', 'You cannot add some medicines, its already being sold by other distributor in your region');
                            }
                        }
                    }


                    $record = InventoryDistributor::where(
                        'DistributorShopId',
                        $distributorshop->DistributorShopId)
                        ->where('MedicineId', $key)->first();
                    if ($record)
                    {
                        //Medicine exist in inventory
                        $record->Quantity += $value[0];
                        $record->UnitPrice = ($value[1] == 0) ? ($record->UnitPrice) : ($value[1]);
                        $record->save();
                    }
                    else
                    {
                        //Medicine does not exist in inventory
                        InventoryDistributor::create([
                            'DistributorShopId' => $distributorshop->DistributorShopId,
                            'MedicineId' => $key,
                            'Quantity' => $value[0],
                            'UnitPrice' => $value[1]
                        ]);
                    }
                }
                break;
        }

        return redirect(route('inventory.index'))->with('success', 'Item added into Inventory');
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
        //Edit Inventory Item Form
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $data = RetailerShop::select('RetailerShopId')
                ->with(['inventories' => function($query) use ($id){
                    $query->where('InventoryId', $id);
                },
                'inventories.medicine'])->where('UserId', Auth::id())->first();
                break;

            case 'Distributor':
                $data = DistributorShop::select('DistributorShopId')
                ->with(['inventories' => function($query) use ($id){
                    $query->where('InventoryId', $id);
                },
                'inventories.medicine'])->where('UserId', Auth::id())->first();
                break;
        }

        if(!$data->inventories->count())
        {
            abort(404);
        }

        return view('testingViews.inventoryedit')->with('data', $data);
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
        //Update Inventory Item
        $this->validate($request, [
            'quantity' => 'required',
            'unitprice' => 'required'
        ]);

        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $record = InventoryRetailer::find($id);
                $record->quantity = $request->input('quantity');
                $record->unitprice = $request->input('unitprice');
                $record->save();
                break;

            case 'Distributor':
                $record = InventoryDistributor::find($id);
                $record->quantity = $request->input('quantity');
                $record->unitprice = $request->input('unitprice');
                $record->save();
                break;
        }

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
        //Delete item from inventory
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                InventoryRetailer::destroy($id);
                break;

            case 'Distributor':
                InventoryDistributor::destroy($id);
                break;
        }
        return redirect(route('inventory.index'))->with('success', 'Item is deleted from inventory');
    }
}
