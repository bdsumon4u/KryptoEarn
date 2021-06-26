<?php

namespace App\Http\Livewire\User;

use App\Http\Controllers\PlanController;
use Livewire\Component;

class PlanUpgrade extends Component
{
    public $plans;
    public $selected;
    public $plan_id;

    public function mount($plans)
    {
        $this->plans = $plans;
    }

    public function render()
    {
        return view('livewire.user.plan-upgrade');
    }

    public function submit()
    {
        resolve(PlanController::class)->update(request(), $this->plans->first(fn ($plan) => $plan->id == $this->plan_id));
        $this->redirectAction([PlanController::class, 'index']);
    }
}
