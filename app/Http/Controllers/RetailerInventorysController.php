<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RetailerShop;
use Illuminate\Support\Facades\Auth;
use PDO;

class RetailerInventorysController extends Controller
{
    public function show()
    {
        $retailerInfo = RetailerShop::with('inventories','inventories.medicine')->where('UserId', Auth::id())->first();
        // return $retailerInfo;
        return view('inventory',compact('retailerInfo'));
    }
}
