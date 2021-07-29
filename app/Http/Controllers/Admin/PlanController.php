<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanRequest;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Cache::tags('plans')->rememberForever('plans:all', function () {
            return Plan::all();
        });

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.plans.editor', [
            'plan' => new Plan,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PlanRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        Plan::create($request->validData());

        return redirect()->action([static::class, 'index'])->with('success', 'A New Plan Is Created.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return view('admin.plans.editor');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PlanRequest $request
     * @param \App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        $plan->update($request->validData());

        return redirect()->action([static::class, 'index'])->with('success', 'The Plan Is Updated.');
    }

    public function destroy(Plan $plan)
    {
        $user = User::whereHas('membership.plan', function ($query) use ($plan) {
            $query->where('id', $plan->id);
        })->first();
        if ($user) {
            return back()->with('error', 'User: "' . $user->username . '" Has This Plan. You Can\'t Delete It.');
        }
        $plan->delete();
        return back()->with('success', 'Plan Deleted.');
    }
}
