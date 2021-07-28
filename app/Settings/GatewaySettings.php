<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GatewaySettings extends Settings
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

    public static function group(): string
    {
        return 'gateway';
    }
}
