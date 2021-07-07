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
Route::get('/proofs', \App\Http\Controllers\ProofController::class);
Route::post('/contact-mail', \App\Http\Controllers\ContactController::class);

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)->name('dashboard');
    Route::middleware(\App\Http\Middleware\NotBlockedUser::class)->group(function () {
        Route::resource('/plans', \App\Http\Controllers\PlanController::class)->only(['index', 'update']);
        Route::resource('/tasks', \App\Http\Controllers\TaskController::class)->only(['index', 'store']);
        Route::match(['get', 'post'], '/vouchers/redeem', \App\Http\Controllers\RedeemVoucherController::class)->name('vouchers.redeem');
        Route::resource('/vouchers', \App\Http\Controllers\VoucherController::class)->only(['index', 'create', 'store']);
        Route::get('/wallet', \App\Http\Controllers\WalletController::class)->name('wallet');
        Route::patch('/gateway', \App\Http\Controllers\GatewayController::class)->name('gateway');
        Route::get('/wallet/transfer', [\App\Http\Controllers\WalletController::class, 'transfer'])->name('wallet.transfer');
        Route::resource('/partners', \App\Http\Controllers\PartnerController::class)->except(['edit', 'update', 'destroy']);
        Route::get('/referrals', \App\Http\Controllers\ReferralController::class)->name('referrals');
        Route::post('/membership/{plan}/upgrade', \App\Http\Controllers\MembershipController::class)->name('membership.upgrade');

        Route::resource('/deposits', \App\Http\Controllers\DepositController::class);
        Route::resource('/withdraws', \App\Http\Controllers\WithdrawController::class);
    });
});

Route::group(['prefix' => 'ipn', 'as' => 'ipn.'], function () {
    Route::post('perfect-money', [\App\Http\Gateways\PerfectMoney\ProcessController::class, 'ipn'])->name('perfect-money');
    Route::get('blockchain', [\App\Http\Gateways\Blockchain\ProcessController::class, 'ipn'])->name('blockchain');
    Route::post('payeer', [\App\Http\Gateways\Payeer\ProcessController::class, 'ipn'])->name('payeer');
});
