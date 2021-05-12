<?php

namespace App\Http\Livewire\User;

use Bavix\Wallet\Models\Wallet;
use Illuminate\Validation\Rule;
use Livewire\Component;

class WalletToWalletTransfer extends Component
{
    public array $wallets = [
        'earning' => [],
        'purchased' => [
            'earning',
            'commission',
            'bonus',
        ],
        'commission' => [
            'earning',
        ],
        'bonus' => [
            'earning',
        ],
    ];

    public string $source;
    public ?string $destination;
    public $amount;

    public function rules()
    {
        return [
            'source' => ['required', Rule::in(array_keys($this->wallets))],
            'destination' => ['required', Rule::in($this->wallets[$this->source] ?? [])],
            'amount' => ['required', 'numeric'],
        ];
    }

    public function mount()
    {
        $this->source = array_key_first($this->wallets);
    }

    public function updatedSource(string $source)
    {
        $this->destination = data_get($this->wallets[$source] ?? [], 0);
    }

    public function render()
    {
        return view('livewire.user.wallet-to-wallet-transfer');
    }

    public function submit()
    {
        $this->validate();

        $sourcePocket = $this->wallet($this->source);
        $destinationPocket = $this->wallet($this->destination);

        if ($sourcePocket->balanceFloat < $this->amount) {
            $this->dispatchBrowserEvent('alert', [
                'type' => 'danger',
                'message' => 'Insufficient Balance!',
            ]);

            return false;
        }

        $sourcePocket->safeExchange($destinationPocket, $this->amount * 100, [
            'name' => strtoupper($this->source).' To '.strtoupper($this->destination),
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
