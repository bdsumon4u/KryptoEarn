<?php

namespace App\Http\Controllers;

use App\Jobs\ReferralTaskCompleteCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        return view('user.tasks', [
            'user' => $request->user(),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->skip === 'skip') {
            return back();
        }

        $user = $request->user();

        if (!$membership = $user->membership) {
            return back()->with('error', 'Your Membership Is Expired');
        }

        if ($membership->tomorrow->isFuture()) {
            return back()->with('error', 'Better Luck Next Time: ' . $user->membership->tomorrow->format('d-M-Y H:i A'));
        }

        DB::beginTransaction();
        $trans = $user->earningPocket()->deposit($user->earning_per_task, [
            'name' => 'Task Complete',
        ]);

        if ($user->task_remaining - 1) {
            $membership->increment('task_completed');
        } else {
            $membership->update([
                'task_completed' => 0,
                'tomorrow' => now()->addMinutes(5),
            ]);
        }
        DB::commit();

        ReferralTaskCompleteCommission::dispatch($user);

        return back()->with('success', '$'.round($trans->amountFloat, 2).' Credited To Your Earning Balance.');
    }
}
