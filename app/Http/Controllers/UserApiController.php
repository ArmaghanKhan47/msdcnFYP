<?php

namespace App\Http\Controllers;

use App\Models\DistributorShop;
use App\Models\RetailerShop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Svg\Tag\Rect;

class UserApiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('login');
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
            $user = User::where('email', $request->input('email'))->first();
            if ($user)
            {
                $user->makeVisible(['password']);
                if(Hash::check($request->input('password'), $user->password))
                {
                    //Password matched;
                    return response()->json([
                            'message' => 'Login Successful',
                            'code' => 200,
                            'key' => $user->api_token
                        ]);
                }
                else
                {
                    return response()->json([
                            'message' => 'Invalid Password or Email',
                            'code' => 404
                        ]);
                }
            }
            else
            {
                return response()->json([
                        'message' => 'User Doest not Exist',
                        'code' => 404
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
                $retailer = RetailerShop::with(['pointofsale', 'inventories' => function($query){
                    $query->where('Quantity', '<', 6);
                }, 'inventories.medicine:MedicineId,MedicineName'])->where('UserId', Auth::id())->first();

                $pointofsale = $retailer->pointofsale;
                $today = $pointofsale->filter(function($item, $key){
                    if (date('Y-m-d', strtotime($item['created_at'])) == date('Y-m-d'))
                    {
                        return $item;
                    }
                });

                return response()->json([
                    'TotalRevenue' => $pointofsale->sum('DailyRevenue'),
                    'TotalSales' => $pointofsale->count(),
                    'TodaySales' => $today->count(),
                    'TodayRevenue' => $today->sum('DailyRevenue'),
                    'Inventory' => $retailer->inventories
                ]);
                break;

            case 'Distributor':
                return response()->json([
                    'message' => 'This is Distributor'
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
                    'User' => Auth::user(),
                    'Shop' => RetailerShop::where('UserId', Auth::id())->first()
                ]);
                break;

            case 'Distributor':
                return response()->json([
                    'User' => Auth::user(),
                    'Shop' => DistributorShop::where('UserId', Auth::id())->first()
                ]);
                break;
        }
    }
}
