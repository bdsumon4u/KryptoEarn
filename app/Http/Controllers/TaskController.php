<?php

namespace App\Http\Controllers;

use App\Jobs\ReferralTaskCompleteCommission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    /**
     * @throws \Exception
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $this->forgetCaptcha($user->id);
        $ttl = random_int(1, 5) * 60;
        return view('user.tasks', [
            'user' => $user,
            'timeout' => $ttl,
            'captcha' => cache()
                ->remember('captcha:'.$user->id, $ttl, function () {
                    return [
                        'id' => Str::random(),
                        'provider' => $this->provider(),
                        'type' => $this->type(),
                    ];
                }),
        ]);
    }

    /**
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $user = $request->user();
        if ($request->skip === 'skip') {
            $this->forgetCaptcha($user->id);
            return back();
        }

        if (!cache('captcha:'.$user->id)) {
            return back()->with('error', 'Timeout! Please Retry.');
        }

        if (!$user->valid_till->isFuture()) {
            return back()->with('error', 'Your Membership Is Expired');
        }

        $membership = $user->membership;
        if ($membership->tomorrow->isFuture()) {
            return back()->with('error', 'Better Luck Next Time: ' . $user->membership->tomorrow->formatted(true));
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
                'tomorrow' => now()->addDay(),
            ]);
        }
        DB::commit();

        ReferralTaskCompleteCommission::dispatch($user);
        $this->forgetCaptcha($user->id);

        return back()->with('success', '$'.round($trans->amountFloat, 2).' Credited To Your Earning Balance.');
    }

    private function forgetCaptcha($userId)
    {
        cache()->forget('captcha:'.$userId);
    }

    private function provider()
    {
        $providers = [
            ['source' => 'nytimes.com', 'image' => 'the-new-york-times.jpg'],
            ['source' => 'medium.com', 'image' => 'medium.png'],
            ['source' => 'bbc.com', 'image' => 'bbc.png'],
            ['source' => 'ndtv.com', 'image' => 'ndtv.png'],
            ['source' => 'slideshare.net', 'image' => 'slide-share.png'],
            ['source' => 'dailymotion.com', 'image' => 'dailymotion.png'],
            ['source' => 'reddit.com', 'image' => 'reddit.png'],
        ];
        return $providers[array_rand($providers)];
    }

    private function type()
    {
        $types = ['motion', 'slider'];
        return $types[array_rand($types)];
    }
}
