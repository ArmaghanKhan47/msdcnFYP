<?php

namespace App\Http\Controllers;

use App\Models\DistributorShop;
use Illuminate\Http\Request;
use App\Models\RetailerShop;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    //
    public function index()
    {
        //Get POS data of Retailer to display on Home
        //On Daily Bases
        $sales = null;

        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                //Daily
                $sales = RetailerShop::with(['pointofsale' => function($query){
                    $query->where('created_at', 'LIKE', date('Y-m-d').'%');
                }, 'pointofsale.sales' => function($query){
                    $query->orderBy('updated_at', 'asc');
                }])->where('UserId', Auth::id())->first()->pointofsale;
                if($sales->count() > 0)
                {
                    $sales = $sales[0]->sales;
                }
                break;

            case 'Distributor':
                //Daily
                $sales = DistributorShop::select('DistributorShopId')->with(['orders' => function($query){
                    $query->select('OrderId', 'PayableAmount', 'DistributorId')->where('created_at', 'LIKE', date('Y-m-d') . '%')->where('OrderStatus', 'LIKE', 'Completed%');
                }])->where('UserId', Auth::id())->first()->orders;
                break;
        }

        return view('testingViews.reports', compact('sales'));
    }

    public function reportsByDaily()
    {
        $sales = null;
        $labels = null;
        $data = null;
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $sales = RetailerShop::with(['pointofsale' => function($query){
                    $query->where('created_at', 'LIKE', date('Y-m-d').'%');
                }, 'pointofsale.sales' => function($query){
                    $query->orderBy('updated_at', 'asc');
                }])->where('UserId', Auth::id())->first()->pointofsale;
                if($sales->count() > 0)
                {
                    $sales = $sales[0]->sales;
                }
                $labels = $sales->map(function($item, $key){
                    return $item->SaleId;
                });
                $data = $sales->map(function($item, $key){
                    return $item->Payed;
                });
                break;

            case 'Distributor':
                $sales = DistributorShop::select('DistributorShopId')->with(['orders' => function($query){
                    $query->select('OrderId', 'PayableAmount', 'DistributorId')->where('created_at', 'LIKE', date('Y-m-d') . '%')->where('OrderStatus', 'LIKE', 'Completed%');
                }])->where('UserId', Auth::id())->first()->orders;

                $labels = $sales->map(function($item, $key){
                    return $item->OrderId;
                });
                $data = $sales->map(function($item, $key){
                    return $item->PayableAmount;
                });
                break;
        }
        return response()->json([$labels, $data]);
    }

    public function reportsByWeekly()
    {
        $sales = null;
        $labels = null;
        $data = null;
        
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $sales = RetailerShop::with(['pointofsale'])->where('UserId', Auth::id())->first()->pointofsale;
                $labels = $sales->map(function($item, $key){
                    return $item->RecordId;
                });
                $data = $sales->map(function($item, $key){
                    return $item->DailyRevenue;
                });
                break;

            case 'Distributor':
                break;
        }
        return response()->json([$labels, $data]);
    }

    public function reportsByMonthly()
    {
        $sales = RetailerShop::with(['pointofsale'])->where('UserId', Auth::id())->first()->pointofsale;

        $grouped = $sales->mapToGroups(function($item, $key){
            $dat = date('M', strtotime($item['created_at']));
            return [$dat => $item];
        });
        $data = $grouped->map(function($item, $key){
            return $item->sum('DailyRevenue');
        })->values();
        $labels = $grouped->map(function($item, $key){
            return $key;
        })->values();
        return response()->json([$labels, $data]);
    }

    public function reportsByYearly()
    {
        $sales = RetailerShop::with(['pointofsale'])->where('UserId', Auth::id())->first()->pointofsale;

        $grouped = $sales->mapToGroups(function($item, $key){
            $dat = date('Y', strtotime($item['created_at']));
            return [$dat => $item];
        });
        $data = $grouped->map(function($item, $key){
            return $item->sum('DailyRevenue');
        })->values();
        $labels = $grouped->map(function($item, $key){
            return $key;
        })->values();
        return response()->json([$labels, $data]);
    }
}
