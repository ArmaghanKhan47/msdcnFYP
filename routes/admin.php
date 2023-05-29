<?php

use App\Http\Controllers\AdminAuth\LoginController;;
use App\Http\Controllers\AdminControllers\AdminDashboardController;
use App\Http\Controllers\AdminControllers\AdminSettingController;
use App\Http\Controllers\AdminControllers\RegisteredUsersController;
use App\Http\Controllers\AdminControllers\RequestController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\RequestController as FeedbackController;
use Illuminate\Support\Facades\Route;

//Defining Admin Routes
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::middleware(['auth:admin', 'noticount'])->group(function(){
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('medicine', MedicineController::class);

        Route::get('/pending-requests', [RequestController::class, 'index'])->name('pending.index');

        Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedback.index');
        Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
        Route::put('/feedback/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
        Route::put('/feedback/{id}/completed', [FeedbackController::class, 'changeStatus'])->name('feedback.completed');

        Route::put('/request/accepted/{userid}', [RequestController::class, 'update'])->name('request.accepte');
        Route::delete('/request/rejected/{userid}', [RequestController::class, 'destroy'])->name('request.rejected');
        Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
        Route::post('/settings/changepassword', [AdminSettingController::class, 'updatePassword'])->name('settings.changepassword');
        Route::post('/settings/mobileaccount', [AdminSettingController::class, 'saveMobileAccountSettings'])->name('settings.mobileaccountsave');

        Route::resource('registered-users', RegisteredUsersController::class);
    });
});
