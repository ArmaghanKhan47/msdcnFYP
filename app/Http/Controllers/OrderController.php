<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryDistributor;

class OrderController extends Controller
{
    //
    public function index()
    {
        $result = InventoryDistributor::with('distributor', 'medicine')->get();
        // $data = DistributorShop::with('inventories.medicine')->select('DistributorShopId' ,'DistributorShopName')->get();
        return view('testingViews.order')->with('data', $result);
    }
}
