<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\InventorySearchController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::prefix('/retailer')->name('retailer.')->middleware(['auth', 'regcheck', 'noticount'])->group(function () {
    Route::post('/inventory/search', [InventorySearchController::class, 'retailerInventorySearch'])->name('inventory.search');

    Route::get('/onlineorder', [OrderController::class, 'index'])->name('order.index');
    Route::get('/ordercheckout', [OrderController::class, 'create'])->name('order.checkout');
    Route::put('/ordercheckout', [OrderController::class, 'store']);
    Route::get('/quickorder/{medicineName}', [OrderController::class, 'quickOrder'])->name('order.quick');

    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/newsale', [SaleController::class, 'create'])->name('sales.newsale');
    Route::post('/sales/newsale', [SaleController::class, 'store']);
    Route::post('/search', [SearchController::class, 'search']);

    require(__DIR__ . '/common.php');
});
