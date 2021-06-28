<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserToAgentTransfer extends Component
{
    public string $destination = 'purchased';
    public string $source = 'earning';
    public string $username = '';
    public $amount;

    public function rules()
    {
        return [
            'username' => ['required', 'string'],
            'amount' => ['required', 'numeric', 'min:'.config('others.minimum_user_to_user_transfer', 10)],
        ];
    }

    public function render()
    {
        return view('livewire.user.user-to-agent-transfer');
    }

    public function submit()
    {
        $this->validate();

        if (!$reciever = User::firstWhere('username', $this->username)) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'danger',
                'message' => 'Receiver Not Found.',
            ]);

            return false;
        }

        if ($reciever->is(request()->user())) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'danger',
                'message' => 'Use "Wallet To Wallet" Transfer.',
            ]);

            return false;
        }

        $sourcePocket = $this->wallet($this->source);

        if ($sourcePocket->balanceFloat < $this->amount) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'danger',
                'message' => 'Insufficient Balance!',
            ]);

            return false;
        }

        if (!$reciever->is_partner) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'danger',
                'message' => 'Agent/Partner Not Found!',
            ]);

            return false;
        }

        DB::beginTransaction();
        $sourcePocket->safeTransfer($reciever->{$this->destination.'Pocket'}(), $this->amount * 100, [
            'name' => request()->user()->username.' To '.$this->username,
            'from_wallet' => $this->source,
            'to_wallet' => $this->destination,
        ]);

        // Agent's/Partner's Commission.
        $reciever->commissionPocket()->depositFloat($this->amount * config('others.partner_receive_money_commission', 2) / 100, [
            'name' => 'Receive Money From '.request()->user()->username,
        ]);
        DB::commit();

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Money Transferred Successfully.',
        ]);
        session()->flash('success', 'Money Transferred Successfully.');
        $this->redirect(back()->getTargetUrl());
    }

    public function wallet(string $name): Wallet
    {
        return request()->user()->{$name.'Pocket'}();
    }
}
