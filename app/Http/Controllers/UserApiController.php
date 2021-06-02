<?php

namespace App\Http\Controllers;

use App\Models\DistributorShop;
use App\Models\RetailerShop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Boolean;
use Svg\Tag\Rect;

class UserApiController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:api', 'subcheck'])->except('login');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //check email and password
        //if given credentials exits, api_token will be returned
        if ($request->has('email') && $request->has('password'))
        {
            $user = User::select('id', 'email', 'password', 'api_token')->where('email', $request->input('email'))->first();
            if ($user)
            {
                $user->makeVisible(['password']);
                if(Hash::check($request->input('password'), $user->password))
                {
                    if ($user->api_token)
                    {
                        //Password matched;
                        return response()->json([
                            'message' => 'Login Successful',
                            'code' => 200,
                            'key' => $user->api_token
                        ]);
                    }
                    return response()->json([
                        'message' => 'No API Key Found, Please try to generate new api token in settings on web app',
                        'code' => 404,
                    ]);

                }
                else
                {
                    return response()->json([
                            'message' => 'Invalid Password or Email',
                            'code' => 401
                        ]);
                }
            }
            else
            {
                return response()->json([
                        'message' => 'Invalid Password or Email',
                        'code' => 401
                    ]);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        //Dashboard info
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                $retailer = RetailerShop::with(['pointofsale.sales', 'inventories' => function($query){
                    $query->where('Quantity', '<', 6);
                }, 'inventories.medicine:MedicineId,MedicineName'])->where('UserId', Auth::id())->first();

                $pointofsale = $retailer->pointofsale;
                $today = null;
                if ($pointofsale->count())
                {
                    $today = $pointofsale->filter(function($item, $key){
                        if (date('Y-m-d', strtotime($item['created_at'])) == date('Y-m-d'))
                        {
                            return $item;
                        }
                    })->values()->first()->sales;
                }

                return response()->json([
                    'message' => 'authenticated',
                    'TotalRevenue' => $pointofsale->sum('DailyRevenue'),
                    'TotalSales' => $pointofsale->count(),
                    'TodaySales' => $today ? $today->count() : 0,
                    'TodayRevenue' => $today ? $today->sum('Payed') : 0,
                    'LowInventory' => $retailer->inventories
                ]);
                break;

            case 'Distributor':
                $distributor = DistributorShop::with(['orders' => function($query){
                    $query->where('OrderStatus', 'LIKE', 'Completed%');
                }, 'inventories' => function($query){
                    $query->where('Quantity', '<', 6);
                }, 'inventories.medicine:MedicineId,MedicineName'])->where('UserId', Auth::id())->first();

                $today = $distributor->orders->filter(function($item, $key){
                    if (date('Y-m-d', strtotime($item['updated_at'])) == date('Y-m-d'))
                    {
                        return $item;
                    }
                });
                return response()->json([
                    'message' => 'authenticated',
                    'TotalRevenue' => $distributor->orders->sum('PayableAmount'),
                    'TotalSales' => $distributor->orders->count(),
                    'TodaySales' => $today->count(),
                    'TodayRevenue' => $today->sum('PayableAmount'),
                    'LowInventory' => $distributor->inventories
                ]);
                break;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        //About Info
        switch(Auth::user()->UserType)
        {
            case 'Retailer':
                return response()->json([
                    'message' => 'authenticated',
                    'User' => Auth::user(),
                    'Shop' => RetailerShop::where('UserId', Auth::id())->first()
                ]);
                break;

            case 'Distributor':
                return response()->json([
                    'message' => 'authenticated',
                    'User' => Auth::user(),
                    'Shop' => DistributorShop::where('UserId', Auth::id())->first()
                ]);
                break;
        }
    }
}
