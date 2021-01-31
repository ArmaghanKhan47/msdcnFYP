<?php

namespace App\Http\Controllers;

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
        $userData = \App\Models\User::with('retailershop', 'retailershop.subscriptions', 'retailershop.subscriptions.package')->find(Auth::id());
        if ($userData->UserType != 'Retailer')
        {
            //User is not retailer
            Auth::logout();
            return redirect(route('login'))->with('error', 'Only Retailer Login');
        }

        if ($userData->retailershop == null)
        {
            //User hasn't completed registration process
            return redirect(route('shopregistration.index'));
        }

        if ($userData->retailershop->subscriptions->count() == 0)
        {
            //Not subscribed any offer
            session(['error' => 'You Haven\'t Subscribed yet!']);
        }

        // return $userData;
        return view('home')->with('data', $userData);
    }
}
