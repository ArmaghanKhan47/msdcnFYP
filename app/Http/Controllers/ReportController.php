<?php

namespace App\Http\Controllers;

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
        $sales = RetailerShop::with(['pointofsale' => function($query){
            $query->where('created_at', 'LIKE', date('Y-m-d').'%');
        }, 'pointofsale.sales' => function($query){
            $query->orderBy('updated_at', 'asc');
        }])->where('UserId', Auth::id())->first()->pointofsale;
        if($sales->count() > 0)
        {
            $sales = $sales[0]->sales;
        }
        return view('testingViews.reports', compact('sales'));
    }

    public function reportsByDaily()
    {
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
        return response()->json([$labels, $data]);
    }

    public function reportsByWeekly()
    {
        $sales = RetailerShop::with(['pointofsale'])->where('UserId', Auth::id())->first()->pointofsale;

        $labels = $sales->map(function($item, $key){
            return $item->RecordId;
        });
        $data = $sales->map(function($item, $key){
            return $item->DailyRevenue;
        });
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
