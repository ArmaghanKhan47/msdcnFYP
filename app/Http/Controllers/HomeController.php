<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $userData = \App\Models\User::with('retailershop', 'retailershop.subscriptions', 'retailershop.subscriptions.package')->find(Auth::id());
        if ($userData->retailerShop == null)
        {
            Auth::logout();
            return 'Not Retailer';
        }

        // return $userData;
        return view('home')->with('data', $userData);
    }
}
