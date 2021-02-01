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

        if($user->UserType == 'Retailer')
        {
            //Pull Retailer Subscription Records
            $retailer = RetailerShop::where('UserId', '=', Auth::id())->select('RetailerShopId')->first();
            $data = SubscriptionHistoryRetailer::with('package')->where('RetailerId', '=', $retailer->RetailerShopId)->orderBy('created_at', 'desc')->get();
        }
        elseif($user->UserType == 'Distributor')
        {
            //Pull Distributor Subscription Records
            $distributor = DistributorShop::where('UserId', '=', Auth::id())->select('DistributorShopId')->first();
            $data = SubscriptionHistoryDistributor::with('package')->where('DistributorId', '=', $distributor->DistributorShopId)->orderBy('created_at', 'desc')->get();
        }

        // return $data;
        return view('testingViews.subscriptionhistory')->with('data', $data);
    }
}
