<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryRetailer;
use App\Models\RetailerShop;

class RetailerInventorysController extends Controller
{
    public function show($id)
    {
        // $retialerInfo = RetailerShop::select(['RetailerName', 'RetailerShopName', 'ContactNumber', 'Region', 'AccountStatus'])->where('RetailerShopId', $id)->get();
        // $data = InventoryRetailer::select(['Quantity', 'UnitPrice', 'MedicineName', 'MedicineFormula', 'MedicineCompany'])->join('medicines', 'medicines.medicineId','inventory_retailers.medicineId')->where('RetailerShopId', $id)->get();
        $retialerInfo = RetailerShop::find($id);
        $data = $retialerInfo->inventory;
        return view('inventory')->with('data', [$retialerInfo, $data]);
    }
}
