<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionHistoryRetailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RetailerShop;
use App\Models\DistributorShop;
use App\Models\SubscriptionHistoryDistributor;

class SubscriptionHistoryController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = null;

        switch($user->UserType)
        {
            case 'Retailer':
                //Pull Retailer Subscription Records
                $data = RetailerShop::with(['subscriptions' => function($query){
                    $query->latest();
                }])->where('UserId', $user->id)->select('RetailerShopId')->first()->subscriptions;
                break;

            case 'Distributor':
                //Pull Distributor Subscription Records
                $data = DistributorShop::with(['subscriptions' => function($query){
                    $query->latest();
                }])->where('UserId', '=', $user->id)->select('DistributorShopId')->first()->subscriptions;
                break;
        }
        return view('testingViews.subscriptionhistory')->with('data', $data);
    }
}
