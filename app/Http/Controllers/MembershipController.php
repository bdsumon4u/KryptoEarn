<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Plan $plan)
    {
        if ($request->user()->purchase($plan)) {
            dd('Error While Upgrading Plan.');
        }

        return back()->with('success', 'Your Plan Is Upgraded.');
    }
}
