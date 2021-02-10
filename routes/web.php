<?php

use App\Http\Controllers\AdminAuth\ConfirmPasswordController;
use App\Http\Controllers\AdminAuth\ForgotPasswordController;
use App\Http\Controllers\AdminAuth\LoginController;
use App\Http\Controllers\AdminAuth\RegisterController as AdminAuthRegisterController;
use App\Http\Controllers\AdminAuth\ResetPasswordController;
use App\Http\Controllers\AdminControllers\AdminDashboardController;
use App\Http\Controllers\AdminControllers\RequestController;
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
    Route::delete('/cart/{itemid}', [CartController::class, 'destroy'])->whereNumber('itemid')->name('cart.remove');

    Route::get('/settings', SettingController::class);
});

//Defining Admin Routes

Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::middleware('auth:admin')->group(function(){
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::get('/medicine/create', [MedicineController::class, 'create'])->name('medicine.create');
        Route::post('/medicine/create', [MedicineController::class, 'store']);
        Route::get('/medicine', [MedicineController::class, 'index'])->name('medicine.index');
        Route::get('/medicine/edit/{id}', [MedicineController::class, 'edit'])->name('medicine.edit');
        Route::put('/medicine/edit/{id}', [MedicineController::class, 'update']);
        Route::delete('/medicine/delete/{id}', [MedicineController::class, 'destroy'])->name('medicine.delete');

        Route::get('/subscriptions', [SubscriptionController::class, 'adminindex'])->name('subscription.index');
        Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscription.create');
        Route::post('/subscriptions/create', [SubscriptionController::class, 'store']);

        Route::get('/pendingrequests', [RequestController::class, 'index'])->name('pending.index');
        Route::put('/request/accepted/{userid}', [RequestController::class, 'update'])->name('request.accepte');
    });
});
