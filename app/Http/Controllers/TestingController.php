<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestingController extends Controller
{
    public function index()
    {
        $d = function(){
            //$data = \App\Models\RetailerShop::select('RetailerShopID')->get()->toArray();
        $data = \App\Models\SubscriptionPackage::select('PackageId')->get()->toArray();
        $new = array();
        foreach($data as $item)
        {
            array_push($new, array_values($item)[0]);
        }
        //return view('testingViews.testing')->with('data', $new);
        return $new;
        };

        return ;
    }
}
