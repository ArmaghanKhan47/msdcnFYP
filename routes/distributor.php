<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\MobileBankController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::prefix('/distributor')->name('distributor.')->middleware(['auth', 'regcheck', 'noticount'])->group(function () {
    Route::post('order/status', [OrderController::class, 'update']);
    Route::post('/settings/mobileaccount', [SettingController::class, 'saveMobileAccountSettings'])->name('setting.mobileaccountsave');
    Route::delete('/settings/mobileaccount', [MobileBankController::class, 'destroy']);

    require(__DIR__ . '/common.php');
});
