<?php

namespace App\Http\Controllers\AdminControllers;

use App\Enums\AccountStatus;
use App\Models\PointOfSaleRetailerRecord;
use App\Models\RetailerShop;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Distributor;
use App\Models\DistributorShop;
use App\Models\Medicine;
use App\Models\Retailer;
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
        $data['retailers'] = User::hasMorph('userable', [Retailer::class])
        ->where('account_status', AccountStatus::$ACTIVE)
        ->count();
        //Total Registered Distributors

        $data['distributors'] = User::hasMorph('userable', [Distributor::class])
        ->where('account_status', AccountStatus::$ACTIVE)
        ->count();
        //Total Medicines
        $data['medicines'] = Medicine::count();
        return view('admin.main.home', $data);
    }
}
