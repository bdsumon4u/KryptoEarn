<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::domain(admin_url())->group(function () {
    Route::redirect('/', '/dashboard');
    Route::group(['middleware' => ['auth:sanctum,admin', 'verified']], function () {
        Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('dashboard');
        Route::resource('/plans', \App\Http\Controllers\Admin\PlanController::class)->except(['show', 'destroy']);
        Route::resource('/users', \App\Http\Controllers\Admin\UserController::class)->only(['index', 'edit', 'update']);
        Route::resource('/deposits', \App\Http\Controllers\Admin\DepositController::class);
        Route::resource('/withdraws', \App\Http\Controllers\Admin\WithdrawController::class);
        Route::resource('/partners', \App\Http\Controllers\Admin\PartnerController::class)->only(['index', 'update']);
        Route::get('/reports', \App\Http\Controllers\Admin\ReportController::class)->name('reports');
        Route::view('/settings/{tab?}', 'admin.settings')->name('settings');
    });
});
