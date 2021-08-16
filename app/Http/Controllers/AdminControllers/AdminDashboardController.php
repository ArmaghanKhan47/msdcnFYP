<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\PointOfSaleRetailerRecord;
use App\Models\RetailerShop;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\DistributorShop;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\assertEmpty;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Total Registered Retailers
        $retailers = User::select('id', 'AccountStatus', 'UserType')
        ->where('AccountStatus','Active')
        ->where('UserType','Retailer')
        ->get()->count();
        //Total Registered Distributors
        $distributors = User::select('id', 'AccountStatus', 'UserType')
        ->where('AccountStatus','Active')
        ->where('UserType','Distributor')
        ->get()->count();
        //Total Medicines
        $medicines = Medicine::get()->count();
        return view('admin.main.home', compact('retailers', 'distributors', 'medicines'));
    }
}
