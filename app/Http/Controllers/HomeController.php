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
        $user = User::with('userable')->find(Auth::id());

        $shop = $this->isShopRegistered($user);
        if($shop != null){
            return $shop;
        }

        // $this->getSubscription($data);

        $sales = [];
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                //Get POS data of Retailer to display on Home
                $sales = RetailerShop::with(['pointofsale' => function($query){
                    $query->where('created_at', 'LIKE', date('Y-m-d').'%');
                },
                'pointofsale.sales' => function($query){
                    $query->orderBy('updated_at', 'asc');
                },
                'pointofsale.sales.saleitems'])
                ->where('UserId', Auth::id())->first()->pointofsale;
                if($sales->count() > 0)
                {
                    $sales = $sales[0]->sales;
                }
                break;

            case 'Distributor':
                $sales = DistributorShop::with(['orders' => function($query){
                    $query->where('OrderStatus', 'LIKE', 'Completed%')
                    ->where('updated_at', 'LIKE', date('Y-m-d') . '%');
                }])->where('UserId', Auth::id())->first()->orders;
                break;
        }
        return view('home', compact('user', 'sales'));
    }

    private function isShopRegistered($userData)
    {
        //Check that shop exist or note
        //Meaning Registration is incomplete
        if ($userData->userable == null)
        {
            return redirect(route('shopregistration.index'))
            ->with('error', 'Please complete registration process, in order to continue');
        }
        return null;

    }
}
