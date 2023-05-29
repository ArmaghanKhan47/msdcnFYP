<?php

use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RequestController as FeedbackController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopRegistrationController;
use Illuminate\Support\Facades\Route;

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

Route::resource('/shop-registration', ShopRegistrationController::class)->only(['index', 'store'])->withoutMiddleware('regcheck');
Route::get('/settings', [SettingController::class, 'index'])->withoutMiddleware('regcheck')->name('settings.index');
Route::post('/settings/api/token/regenerate', [SettingController::class, 'regenerateApiToken'])->name('api.token.regenerate');
Route::post('/settings/shopaddress', [SettingController::class, 'updateShopAddress'])->name('setting.shopaddress');
Route::post('/settings/reapplied', [SettingController::class, 'reapply'])->name('settings.reapply');
Route::post('/settings/changepassword', [SettingController::class, 'changePassword'])->name('settings.changepassword');
Route::post('/settings/contactnumber', [SettingController::class, 'updateContactNumber'])->name('setting.contactnumber');
