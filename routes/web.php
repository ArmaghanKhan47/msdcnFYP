<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingController;
use App\Models\InventoryRetailer;
use App\Http\Controllers\ShopRegistrationController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\SubscriptionHistoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/onlineorder', [OrderController::class, 'index']);
    Route::get('/ordercheckout', [OrderController::class, 'create']);
    Route::put('/ordercheckout', [OrderController::class, 'store']);
    Route::get('/order/history',[OrderController::class, 'show']);
    Route::post('order/status', [OrderController::class, 'update']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/medicine/{id}/detail/{distributorid}', [MedicineController::class, 'show'])->whereNumber(['id', 'distributorid']);
    Route::resource('/inventory', InventoryController::class);

    Route::post('/search/{option}/{query}', [SearchController::class, 'search'])->whereNumber('option')->whereAlphaNumeric('query');

    Route::resource('/shopregistration', ShopRegistrationController::class);

    Route::resource('/subscription', SubscriptionController::class);

    Route::get('/subscriptionhistory', [SubscriptionHistoryController::class, 'index']);

    Route::get('/cart', [CartController::class, 'index']);
    Route::put('/cart', [CartController::class, 'store']);

    Route::get('/settings', SettingController::class);
});
