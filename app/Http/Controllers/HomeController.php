<?php

namespace App\Http\Controllers;

use App\Models\DistributorShop;
use App\Models\PointOfSaleRetailerRecord;
use App\Models\RetailerShop;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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

        $notifications = User::find(Auth::id())->unreadNotifications->count();
        session(['notificationscount' => $notifications]);

        $this->getSubscription($data);

        $sales = null;
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                //Get POS data of Retailer to display on Home
                $sales = RetailerShop::with(['pointofsale' => function($query){
                    $query->where('created_at', 'LIKE', date('Y-m-d').'%');
                }, 'pointofsale.sales' => function($query){
                    $query->orderBy('updated_at', 'asc');
                }, 'pointofsale.sales.saleitems'])->where('UserId', Auth::id())->first()->pointofsale;
                if($sales->count() > 0)
                {
                    $sales = $sales[0]->sales;
                }
                break;

            case 'Distributor':
                $sales = DistributorShop::with(['orders' => function($query){
                    $query->where('OrderStatus', 'LIKE', 'Completed%');
                }])->where('UserId', Auth::id())->first()->orders;
                break;
        }
        session(['region' => RetailerShop::select('Region')->where('UserId', Auth::id())->first()->Region]);
        return view('home', compact('data', 'sales', 'notifications'));
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
                    // session(['error' => 'You Haven\'t Subscribed yet! <a href="/subscription" class="link-danger">Click Here</a>']);
                    // Session::flash('error', 'You Haven\'t Subscribed yet! <a href="/subscription" class="link-danger">Click Here</a>');
                    session()->now('error', 'You Haven\'t Subscribed yet! <a href="/subscription" class="link-danger">Click Here</a>');
                }
                break;

            case 'Distributor':
                if ($userData->distributorshop->subscriptions->count() == 0)
                    {
                        //Not subscribed any offer
                        // session(['error' => 'You Haven\'t Subscribed yet! <a href="/subscription" class="link-danger">Click Here</a>']);
                        // Session::flash('error', 'You Haven\'t Subscribed yet! <a href="/subscription" class="link-danger">Click Here</a>');
                        session()->now('error', 'You Haven\'t Subscribed yet! <a href="/subscription" class="link-danger">Click Here</a>');
                    }
                break;
        }
    }
}
