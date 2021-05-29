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
        $retailers = User::select('id', 'AccountStatus', 'UserType')->where('AccountStatus','Active')->where('UserType','Retailer')->get()->count();
        //Total Registered Distributors
        $distributors = User::select('id', 'AccountStatus', 'UserType')->where('AccountStatus','Active')->where('UserType','Distributor')->get()->count();
        //Total Medicines
        $medicines = Medicine::get()->count();
        return view('admin.main.home', compact('retailers', 'distributors', 'medicines'));
    }

    private function getUserData()
    {
        //Return User Data
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $userData = User::with('retailershop', 'retailershop.subscriptions')->find(Auth::id());
                return $userData;
                break;

            case 'Distributor':
                $userData = User::with('distributorshop', 'distributorshop.subscriptions')->find(Auth::id());
                return $userData;
                break;

            default:
                return null;
        }
    }

    private function getUserShop($userData)
    {
        //Check that shop exist or note
        //Meaning Registration is incomplete
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                if ($userData->retailershop == null)
                {
                    return redirect(route('shopregistration.index'));
                }
                break;

            case 'Distributor':
                if ($userData->distributorshop == null)
                {
                    return redirect(route('shopregistration.index'));
                }
                break;

            default:
                return null;
                break;
        }
    }

    private function getSubscription($userData)
    {
        //Checks that user has 1st subscription or not
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                if ($userData->retailershop->subscriptions->count() == 0)
                {
                    //Not subscribed any offer
                    session(['error' => 'You Haven\'t Subscribed yet!']);
                }
                break;

            case 'Distributor':
                if ($userData->distributorshop->subscriptions->count() == 0)
                    {
                        //Not subscribed any offer
                        session(['error' => 'You Haven\'t Subscribed yet!']);
                    }
                break;
        }
    }
}
