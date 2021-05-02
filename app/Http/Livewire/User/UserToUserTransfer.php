<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Bavix\Wallet\Models\Wallet;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserToUserTransfer extends Component
{
    public array $wallets = ['purchased', 'commission'];
    public string $destination = 'purchased';

    public string $source;
    public string $username = '';
    public $amount;

    public function rules()
    {
        return [
            'source' => ['required', Rule::in($this->wallets)],
            'username' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
        ];
    }

    public function mount()
    {
        $this->source = data_get($this->wallets, 0);
    }

    public function render()
    {
        return view('livewire.user.user-to-user-transfer');
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

        $sourcePocket->safeTransfer($reciever->{$this->destination.'Pocket'}(), $this->amount * 100, [
            'name' => request()->user()->username.' To '.$this->username,
            'from_wallet' => $this->source,
            'to_wallet' => $this->destination,
        ]);

        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Money Transferred Successfully.',
        ]);
    }

    public function wallet(string $name): Wallet
    {
        return request()->user()->{$name.'Pocket'}();
    }
}