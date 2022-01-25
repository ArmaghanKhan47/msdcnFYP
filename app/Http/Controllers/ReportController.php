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
        $sales = [];

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
                $sales = DistributorShop::select('DistributorShopId')
                ->with(['orders' => function($query){
                    $query->select('OrderId', 'PayableAmount', 'DistributorId')
                    ->where('updated_at', 'LIKE', date('Y-m-d') . '%')
                    ->where('OrderStatus', 'LIKE', 'Completed%');
                }])->where('UserId', Auth::id())->first()->orders;
                break;
        }

        return view('partials.reports', compact('sales'));
    }

    public function reportsByDaily()
    {
        //By Daily means: In current day total number of sales will be shown
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
                $sales = DistributorShop::select('DistributorShopId')
                ->with(['orders' => function($query){
                    $query->select('OrderId', 'PayableAmount', 'DistributorId')
                    ->where('created_at', 'LIKE', date('Y-m-d') . '%')
                    ->where('OrderStatus', 'LIKE', 'Completed%');
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
        //By Weekly means: last 7 days revenue will be shown
        $labels = null;
        $data = null;

        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $sales = RetailerShop::with(['pointofsale' => function($query){
                    $query->limit(7)->latest();
                }])->where('UserId', Auth::id())->first()->pointofsale->reverse();
                $labels = $sales->map(function($item, $key){
                    return $item->RecordId;
                })->values();
                $data = $sales->map(function($item, $key){
                    return $item->DailyRevenue;
                })->values();
                break;

            case 'Distributor':
                $sales = DistributorShop::select('DistributorShopId')
                ->with(['orders' => function($query){
                    $query->select('OrderId', 'PayableAmount', 'DistributorId')
                    ->where('OrderStatus', 'LIKE', 'Completed%')->latest()->limit(7);
                }])->where('UserId', Auth::id())->first()->orders->reverse()
                ->mapToGroups(function($item, $key){
                    $dat = date('Y-m-d', strtotime($item['created_at']));
                    return [$dat => $item];
                })->map(function($item, $key){
                    return $item->sum('PayableAmount');
                });

                $labels = $sales->keys();
                $data = $sales->values();
                break;
        }
        return response()->json([$labels, $data]);
    }

    public function reportsByMonthly()
    {
        //By Monthly means: Previous Months Revenue will be shown
        $labels = null;
        $data = null;

        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $sales = RetailerShop::with(['pointofsale'])->where('UserId', Auth::id())->first()->pointofsale;
                $grouped = $sales->mapToGroups(function($item, $key){
                    //Here Record are being grouped on the basis of their month
                    $dat = date('M', strtotime($item['created_at']));
                    return [$dat => $item];
                })->map(function($item, $key){
                    //Here the grouped records are being sum to produce single value
                    return $item->sum('DailyRevenue');
                });

                $data = $grouped->values();
                $labels = $grouped->keys();
                break;

            case 'Distributor':
                $sales = DistributorShop::select('DistributorShopId')
                ->with(['orders' => function($query){
                    //Here only Completed Orders are being selected for futher procecssing
                    $query->select('OrderId', 'PayableAmount', 'DistributorId')
                    ->where('OrderStatus', 'LIKE', 'Completed%');
                }])->where('UserId', Auth::id())->first()->orders
                ->mapToGroups(function($item, $key){
                    //Here fetched results are being grouped on the basis of their Month
                    $dat = date('M', strtotime($item['created_at']));
                    return [$dat => $item];
                })->map(function($item, $key){
                    //Here grouped results are being merged to produce single value
                    return $item->sum('PayableAmount');
                });

                $labels = $sales->keys();
                $data = $sales->values();
                break;
        }
        return response()->json([$labels, $data]);
    }

    public function reportsByYearly()
    {
        $data = null;
        $labels = null;
        //By Yearly means: Previous Years Revenue will be shown
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $sales = RetailerShop::with(['pointofsale'])
                ->where('UserId', Auth::id())->first()->pointofsale
                ->mapToGroups(function($item, $key){
                    //Here Retailer point of sale records are being grouped on the basis of their Year
                    $dat = date('Y', strtotime($item['created_at']));
                    return [$dat => $item];
                })->map(function($item, $key){
                    //Here grouped results are being merged to produce single value
                    return $item->sum('DailyRevenue');
                });

                $data = $sales->values();
                $labels = $sales->keys();
                break;

            case 'Distributor':
                $sales = DistributorShop::select('DistributorShopId')
                ->with(['orders' => function($query){
                    //Here Only Completed Orders are being selected for further processing
                    $query->select('OrderId', 'PayableAmount', 'DistributorId')
                    ->where('OrderStatus', 'LIKE', 'Completed%');
                }])->where('UserId', Auth::id())->first()->orders
                ->mapToGroups(function($item, $key){
                    //Here fetched results are being grouped on the basis of their Year
                    $dat = date('Y', strtotime($item['created_at']));
                    return [$dat => $item];
                })->map(function($item, $key){
                    //Here grouped results are being merged to produce single value
                    return $item->sum('PayableAmount');
                });

                $labels = $sales->keys();
                $data = $sales->values();

                break;
        }

        return response()->json([$labels, $data]);
    }
}
