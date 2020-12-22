<?php

namespace App\Http\Controllers;

use App\Models\DistributorShop;
use App\Models\InventoryDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestingController extends Controller
{
    public function index()
    {
        // $data = DistributorShop::with('inventories.medicine')->select('DistributorShopId' ,'DistributorShopName')->get();
        $data = InventoryDistributor::with('distributor', 'medicine')->get();
        // return $data;
        return view('testingViews.order')->with('data', $data);
    }
}
