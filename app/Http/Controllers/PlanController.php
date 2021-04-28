<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Cache::tags('plans')->rememberForever('plans:active', function () {
            return Plan::whereIsActive(true)->get();
        });

        return view('user.plans', compact('plans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $user = $request->user();

        if (!$plan->price && $user->purchasedPocket()->paid($plan)) {
            return back()->with('error', 'You Can\'t Purchase This Plan Again.');
        }

        if ($user->purchasedPocket()->balance < $plan->getAmountProduct($user)) {
            return back()->with('error', 'Insufficient "PURCHASED" Balance');
        }

        DB::beginTransaction();
        $purchased = $user->purchasedPocket()->pay($plan);
        throw_unless($purchased, "Error While Purchasing Plan #" . $plan->name);

        if (!$request->user()->purchase($plan)) {
            DB::rollBack();
            return back()->with('error', 'Error While Purchasing '.$plan->name.' Plan.');
        }
        DB::commit();

        return back()->with('success', 'You\'ve Migrated To '.$plan->name.' Plan.');
    }
}
