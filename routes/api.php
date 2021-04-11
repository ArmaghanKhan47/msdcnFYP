<?php

use App\Http\Controllers\UserApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Http\Client\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
   Route:
    domain + /api/login, e.g, msdcn.test/api/login

    Required Parameters:
        email : email of user
        password : password for the id

    Required Header:
        Accept => 'application/json' : this header must be set on all api calls to get json responce from system

    Responce Structure:
        Contains following:
            message:
                'Login Successful' => Indicating that provided credentials are valid and valid key will be returned
                'Invalid Email or Password' => Indicating that provided credentials are not valid and no key will be returned
            code:
                200 => Everything is fine
                401 => Unauthenticated
            key:
                Valid user API Key will be returned, on code 200
*/
Route::post('/login', [UserApiController::class, 'login']);

Route::middleware('auth:api')->group(function(){
    /*
        Route:
            domain + /api/dashboard, e.g, msdcn.test/api/dashboard

        Required Parameters:
            api_token : valid user key, which can be obtained from login call

        Required Header:
            Accept => 'application/json' : this header must be set on all api calls to get json responce from system

        Responce Structure:
            Contains follwing:
                If valid key value provided in api_token
                    message:
                        'authenticated' 
                    TotalRevenue:
                        All Time earning
                    TotalSales:
                        All Time Sales made
                    TodayRevenue:
                        Current Day earning
                    TodaySales:
                        Number of sales made on current day
                    LowInventory:
                        Inventory info about medicines which are low in stock

                If invalid key value provided in api_token
                    message:
                        'unauthenticated' => Meaning invalid value is provided in api_token
    */
    Route::post('/dashboard', [UserApiController::class, 'dashboard']);

    /*
        Route:
            domain + /api/about, e.g, msdcn.test/api/about

        Required Parameters:
            api_token : valid user key, which can be obtained from login call

        Required Header:
            Accept => 'application/json' : this header must be set on all api calls to get json responce from system

        Responce Structure:
            Contains follwing:
                If valid key value provided in api_token
                    message:
                        'authenticated'
                    User:
                        Info about the user
                    Shop:
                        Info about the shop

                If invalid key value provided in api_token
                    message:
                        'unauthenticated' => Meaning invalid value is provided in api_token
    */
    Route::post('/about', [UserApiController::class, 'about']);
});
