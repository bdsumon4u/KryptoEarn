<?php

namespace App\Http\Livewire\Admin;

use App\Settings\GatewaySettings;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class GatewaySetting extends Component
{
    use InteractsWithBanner;

    public string $perfect_money_wallet_id;
    public string $perfect_money_passphrase;
    public string $blockchain_secret;
    public string $blockchain_xpub_key;
    public string $blockchain_api_key;
    public string $payeer_merchant_id;
    public string $payeer_secret;

    public $rules = [
        'perfect_money_wallet_id' => 'nullable|max:255',
        'perfect_money_passphrase' => 'nullable|max:255',

        'blockchain_secret' => 'nullable|max:255',
        'blockchain_xpub_key' => 'nullable|max:255',
        'blockchain_api_key' => 'nullable|max:255',

        'payeer_merchant_id' => 'nullable|max:255',
        'payeer_secret' => 'nullable|max:255',
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
