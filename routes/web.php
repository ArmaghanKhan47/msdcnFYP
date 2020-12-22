<?php

use App\Http\Controllers\MedicineController;
use App\Http\Controllers\RetailerInventorysController;
use App\Http\Controllers\TestingController;
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

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/onlineorder', [TestingController::class, 'index']);
    Route::get('/retailer/inventory', [RetailerInventorysController::class, 'show']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('medicine/{id}/detail', [MedicineController::class, 'show']);
});
