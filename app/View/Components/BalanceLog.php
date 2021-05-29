<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class BalanceLog extends Component
{
    public $transactions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->transactions = last_week_user_transactions($user);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.balance-log');
    }
}
