<?php

use App\Http\Controllers\AdminAuth\LoginController;;
use App\Http\Controllers\AdminControllers\AdminDashboardController;
use App\Http\Controllers\AdminControllers\AdminSettingController;
use App\Http\Controllers\AdminControllers\RequestController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventorySearchController;
use App\Http\Controllers\MobileBankController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequestController as FeedbackController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingController;
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
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth', 'subcheck', 'noticount']], function () {

    //Retailer Specific Routes Start
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::put('/cart', [CartController::class, 'store']);
    Route::delete('/cart/{itemid}', [CartController::class, 'destroy'])->whereNumber('itemid')->name('cart.remove');

    Route::post('/inventory/search/retailer', [InventorySearchController::class, 'retailerInventorySearch'])->name('inventory.search.retailer');

    Route::get('/onlineorder', [OrderController::class, 'index'])->name('order.index');
    Route::get('/ordercheckout', [OrderController::class, 'create'])->name('order.checkout');
    Route::put('/ordercheckout', [OrderController::class, 'store']);
    Route::get('/quickorder/{medicineName}', [OrderController::class, 'quickOrder'])->name('order.quick');

    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/newsale', [SaleController::class, 'create'])->name('sales.newsale');
    Route::post('/sales/newsale', [SaleController::class, 'store']);
    Route::post('/search', [SearchController::class, 'search']);
    //Retailer Specific Routes End

    //Distributor Specific Routes Start
    Route::post('order/status', [OrderController::class, 'update']);

    Route::post('/settings/mobileaccount', [SettingController::class, 'saveMobileAccountSettings'])->name('setting.mobileaccountsave');
    Route::delete('/settings/mobileaccount', [MobileBankController::class, 'destroy']);
    //Distributor Specific Routes End

    //Common Routes Start
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/inventory', InventoryController::class);

    Route::get('/medicine/{id}/detail/{distributorid}', [MedicineController::class, 'show'])->whereNumber(['id', 'distributorid']);

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notification.index');
    Route::put('/notification/read/{id}', [NotificationController::class, 'update'])->name('notification.read');
    Route::delete('/notification/delete/{id}', [NotificationController::class, 'destroy'])->name('notification.delete');

    Route::get('/order/history',[OrderController::class, 'show'])->name('orderhistory.show');

    Route::get('/reports', [ReportController::class, 'index'])->name('report.index');
    Route::post('/reports/daily', [ReportController::class, 'reportsByDaily'])->name('reports.daily');
    Route::post('/reports/weekly', [ReportController::class, 'reportsByWeekly'])->name('reports.weekly');
    Route::post('/reports/monthly', [ReportController::class, 'reportsByMonthly'])->name('reports.monthly');
    Route::post('/reports/yearly', [ReportController::class, 'reportsByYearly'])->name('reports.yearly');
    Route::resource('/request', FeedbackController::class)->except(['index', 'edit', 'destroy', 'update']);
    Route::put('/request/{id}', [FeedbackController::class, 'updateUser'])->name('request.update');

    Route::resource('/shopregistration', ShopRegistrationController::class);
    Route::resource('/subscription', SubscriptionController::class)->withoutMiddleware('subcheck')->middleware('subselect');
    Route::get('/subscriptionhistory', [SubscriptionHistoryController::class, 'index'])->withoutMiddleware('subcheck')->name('subscriptionhistory.index');
    Route::get('/settings', [SettingController::class, 'index'])->withoutMiddleware('subcheck')->name('settings.index');
    Route::post('/settings/api/token/regenerate', [SettingController::class, 'regenerateApiToken'])->name('api.token.regenerate');
    Route::post('/settings/shopaddress', [SettingController::class, 'updateShopAddress'])->name('setting.shopaddress');
    Route::post('/settings/reapplied', [SettingController::class, 'reapply'])->withoutMiddleware('subcheck')->name('settings.reapply');
    Route::post('/settings/changepassword', [SettingController::class, 'changePassword'])->name('settings.changepassword');
    Route::post('/settings/creditcard', [CreditCardController::class, 'update'])->name('settings.creditcard');
    Route::delete('/settings/creditcard', [CreditCardController::class, 'destroy']);
    Route::post('/settings/contactnumber', [SettingController::class, 'updateContactNumber'])->name('setting.contactnumber');
    //Common Routes End
});

//Defining Admin Routes
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::middleware(['auth:admin', 'noticount'])->group(function(){
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
        Route::get('/subscriptions/edit/{id}', [SubscriptionController::class, 'edit'])->name('subscription.edit');
        Route::post('/subscriptions/edit/{id}', [SubscriptionController::class, 'adminUpdate']);

        Route::get('/pendingrequests', [RequestController::class, 'index'])->name('pending.index');
        Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedback.index');
        Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
        Route::put('/feedback/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
        Route::put('/feedback/{id}/completed', [FeedbackController::class, 'changeStatus'])->name('feedback.completed');
        Route::put('/request/accepted/{userid}', [RequestController::class, 'update'])->name('request.accepte');
        Route::delete('/request/rejected/{userid}', [RequestController::class, 'destroy'])->name('request.rejected');
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings/changepassword', [AdminSettingController::class, 'updatePassword'])->name('settings.changepassword');
        Route::post('/settings/mobileaccount', [AdminSettingController::class, 'saveMobileAccountSettings'])->name('settings.mobileaccountsave');
    });
});

?>
