<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', \App\Http\Controllers\HomeController::class);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::resource('/plans', \App\Http\Controllers\PlanController::class)->only(['index', 'update']);
    Route::resource('/tasks', \App\Http\Controllers\TaskController::class)->only(['index', 'store']);
    Route::get('/referrals', \App\Http\Controllers\ReferralController::class)->name('referrals');
    Route::post('/membership/{plan}/upgrade', \App\Http\Controllers\MembershipController::class)->name('membership.upgrade');
});
