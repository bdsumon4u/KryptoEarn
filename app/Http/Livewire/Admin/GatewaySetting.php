<?php

namespace App\Http\Livewire\Admin;

use App\Settings\GatewaySettings;
use Livewire\Component;

class GatewaySetting extends Component
{
    public string $perfect_money_wallet_id;
    public string $perfect_money_passphrase;

    public $perfect_money_deposit_min_amount;
    public $perfect_money_deposit_max_amount;
    public $perfect_money_deposit_fixed_charge;
    public $perfect_money_deposit_percent_charge;

    public $perfect_money_withdraw_min_amount;
    public $perfect_money_withdraw_max_amount;
    public $perfect_money_withdraw_fixed_charge;
    public $perfect_money_withdraw_percent_charge;

    public string $blockchain_secret;
    public string $blockchain_xpub_key;
    public string $blockchain_api_key;

    public $blockchain_deposit_min_amount;
    public $blockchain_deposit_max_amount;
    public $blockchain_deposit_fixed_charge;
    public $blockchain_deposit_percent_charge;

    public $blockchain_withdraw_min_amount;
    public $blockchain_withdraw_max_amount;
    public $blockchain_withdraw_fixed_charge;
    public $blockchain_withdraw_percent_charge;

    public string $payeer_merchant_id;
    public string $payeer_secret;

    public $payeer_deposit_min_amount;
    public $payeer_deposit_max_amount;
    public $payeer_deposit_fixed_charge;
    public $payeer_deposit_percent_charge;

    public $payeer_withdraw_min_amount;
    public $payeer_withdraw_max_amount;
    public $payeer_withdraw_fixed_charge;
    public $payeer_withdraw_percent_charge;

    public string $coinbase_api_key;
    public string $coinbase_secret;

    public $coinbase_deposit_min_amount;
    public $coinbase_deposit_max_amount;
    public $coinbase_deposit_fixed_charge;
    public $coinbase_deposit_percent_charge;

    public $coinbase_withdraw_min_amount;
    public $coinbase_withdraw_max_amount;
    public $coinbase_withdraw_fixed_charge;
    public $coinbase_withdraw_percent_charge;

    public $rules = [
        'perfect_money_wallet_id' => 'nullable|max:255',
        'perfect_money_passphrase' => 'nullable|max:255',

        'perfect_money_deposit_min_amount' => 'nullable|integer',
        'perfect_money_deposit_max_amount' => 'nullable|integer',
        'perfect_money_deposit_fixed_charge' => 'nullable|integer',
        'perfect_money_deposit_percent_charge' => 'nullable|integer',

        'perfect_money_withdraw_min_amount' => 'nullable|integer',
        'perfect_money_withdraw_max_amount' => 'nullable|integer',
        'perfect_money_withdraw_fixed_charge' => 'nullable|integer',
        'perfect_money_withdraw_percent_charge' => 'nullable|integer',

        'blockchain_secret' => 'nullable|max:255',
        'blockchain_xpub_key' => 'nullable|max:255',
        'blockchain_api_key' => 'nullable|max:255',

        'blockchain_deposit_min_amount' => 'nullable|integer',
        'blockchain_deposit_max_amount' => 'nullable|integer',
        'blockchain_deposit_fixed_charge' => 'nullable|integer',
        'blockchain_deposit_percent_charge' => 'nullable|integer',

        'blockchain_withdraw_min_amount' => 'nullable|integer',
        'blockchain_withdraw_max_amount' => 'nullable|integer',
        'blockchain_withdraw_fixed_charge' => 'nullable|integer',
        'blockchain_withdraw_percent_charge' => 'nullable|integer',

        'payeer_merchant_id' => 'nullable|max:255',
        'payeer_secret' => 'nullable|max:255',

        'payeer_deposit_min_amount' => 'nullable|integer',
        'payeer_deposit_max_amount' => 'nullable|integer',
        'payeer_deposit_fixed_charge' => 'nullable|integer',
        'payeer_deposit_percent_charge' => 'nullable|integer',

        'payeer_withdraw_min_amount' => 'nullable|integer',
        'payeer_withdraw_max_amount' => 'nullable|integer',
        'payeer_withdraw_fixed_charge' => 'nullable|integer',
        'payeer_withdraw_percent_charge' => 'nullable|integer',

        'coinbase_api_key' => 'nullable|max:255',
        'coinbase_secret' => 'nullable|max:255',

        'coinbase_deposit_min_amount' => 'nullable|integer',
        'coinbase_deposit_max_amount' => 'nullable|integer',
        'coinbase_deposit_fixed_charge' => 'nullable|integer',
        'coinbase_deposit_percent_charge' => 'nullable|integer',

        'coinbase_withdraw_min_amount' => 'nullable|integer',
        'coinbase_withdraw_max_amount' => 'nullable|integer',
        'coinbase_withdraw_fixed_charge' => 'nullable|integer',
        'coinbase_withdraw_percent_charge' => 'nullable|integer',
    ];

    public function mount(GatewaySettings $settings): void
    {
        $this->fill($settings->toArray());
    }

    public function render()
    {
        return view('livewire.admin.gateway-setting');
    }

    public function submit(GatewaySettings $settings): void
    {
        $settings->fill($this->validate())->save();
        $this->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => 'Successfully Saved The Data.',
        ]);
    }
}
