<?php

namespace App\Jobs;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReferralPlanUpgradeCommission implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private User $user;
    private Plan $plan;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Plan $plan)
    {
        $this->user = $user->load('referrer');
        $this->plan = $plan;
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws \Throwable
     */
    public function handle()
    {
        if (!$referrer = $this->user->referrer) {
            return;
        }

        if (!$commission = $referrer->refPlanUpgradeCommission($this->plan->price)) {
            return;
        }

        # Commission is on dollar.
        $referrer->commissionPocket()->depositFloat($commission, [
            'name' => 'Ref. Plan Upgrade',
        ]);
    }
}
