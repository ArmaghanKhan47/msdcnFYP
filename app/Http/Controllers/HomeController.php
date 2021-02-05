<?php

namespace App\Http\Controllers;

use App\Models\PointOfSaleRetailerRecord;
use App\Models\RetailerShop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\assertEmpty;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $userData = User::with('retailershop')->find(Auth::id());
        $data = $this->getUserData();

        $shop = $this->getUserShop($data);
        if($shop != null)
        {
            return $shop;
        }

        $this->getSubscription($data);

        $sales = PointOfSaleRetailerRecord::where('RetailerShopId','=',RetailerShop::where('UserId','=',Auth::id())->first()->RetailerShopId)->get();
        
        // return $sales;
        return view('home', compact('data', 'sales'));
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
