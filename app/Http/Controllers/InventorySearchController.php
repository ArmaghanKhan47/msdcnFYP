<?php

namespace App\Http\Controllers;

use App\Models\InventoryRetailer;
use App\Models\Medicine;
use App\Models\RetailerShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventorySearchController extends Controller
{
    //
    public function retailerInventorySearch(Request $request)
    {
        if ($request->header('accept') == 'application/json')
        {
            $retailerid = RetailerShop::select('RetailerShopId')->where('UserId', Auth::id())->first()->RetailerShopId;
            $query = $request->header('query');
            // $result = Medicine::with(['inventoryretailer' => function($query) use ($retailerid){
            //     $query->where('RetailerShopId', $retailerid);
            // }])->select('MedicineId', 'MedicineName')->where('MedicineName','LIKE', '%' . $query . '%')->get();

            $result = InventoryRetailer::with(['medicine' => function($q) use ($query){
                $q->where('MedicineName','LIKE', '%' . $query . '%');
            }])->where('RetailerShopId', $retailerid)->whereHas('medicine')->get();

            //filtering
            $filtered = $result->filter(function($value,$key){
                return $value->medicine != null;
            });

            return $filtered->toArray();
        }
    }
}
