<?php

use App\Http\Controllers\InventoryRetailerController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RetailerInventorysController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TestingController;
use App\Models\InventoryRetailer;
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

Route::get('/test', [TestingController::class, 'index']);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/onlineorder', [OrderController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/medicine/{id}/detail/{distributorid}', [MedicineController::class, 'show'])->whereNumber(['id', 'distributorid']);
    Route::resource('/inventory', InventoryRetailerController::class);

    Route::post('/search/{option}/{query}', [SearchController::class, 'search'])->whereNumber('option')->whereAlphaNumeric('query');
});
