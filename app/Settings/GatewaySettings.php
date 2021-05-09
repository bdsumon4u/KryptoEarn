<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GatewaySettings extends Settings
{
    public string $perfect_money_wallet_id;
    public string $perfect_money_passphrase;
    public string $blockchain_secret;
    public string $blockchain_xpub_key;
    public string $blockchain_api_key;
    public string $payeer_merchant_id;
    public string $payeer_secret;

    public static function group(): string
    {
        return 'gateway';
    }
}
