<?php

namespace App\Http\Controllers;

use App\Models\Plan;
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

        return view('welcome', compact('plans'));
    }
}
