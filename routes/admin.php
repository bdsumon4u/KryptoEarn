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
    });
});
