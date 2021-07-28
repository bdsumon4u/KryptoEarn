<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $plans = Cache::tags('plans')->rememberForever('plans:active', function () {
            return Plan::whereIsActive(true)->get();
        });
        $totalUsers = \cache()->remember('users:total', 5 * 60, fn () => User::count());
        $totalWithdraws = \cache()->remember('withdraws:total', 5 * 60, fn () => Withdraw::where('status', 'completed')->sum('amount'));

        return view('welcome', compact('plans', 'totalUsers', 'totalWithdraws'));
    }
}
