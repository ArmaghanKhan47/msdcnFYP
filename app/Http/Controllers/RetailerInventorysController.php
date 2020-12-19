<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RetailerShop;
use PDO;

class RetailerInventorysController extends Controller
{
    public function show($id)
    {
        $retailerInfo = RetailerShop::with('inventories','inventories.medicine')->find($id);
        return view('inventory',compact('retailerInfo'));
    }
}
