<?php

namespace App\Http\Controllers;

use App\Enums\AccountStatus;
use App\Models\Distributor;
use App\Models\Retailer;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        //
        // $distributor = Distributor::with('user')->first();
        $retailer = Retailer::with('user')->first();
        $user = User::with('userable')->find(2);
        // $retailer->user()->save($user);
        dump($user);
    }
}
