<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateGatewaySettings extends SettingsMigration
{
    /**
     * @throws \Spatie\LaravelSettings\Exceptions\SettingAlreadyExists
     */
    public function up(): void
    {
        $props = [
            'gateway.perfect_money_wallet_id' => '',
            'gateway.perfect_money_passphrase' => '',

            'gateway.perfect_money_deposit_min_amount' => '',
            'gateway.perfect_money_deposit_max_amount' => '',
            'gateway.perfect_money_deposit_fixed_charge' => '',
            'gateway.perfect_money_deposit_percent_charge' => '',

            'gateway.perfect_money_withdraw_min_amount' => '',
            'gateway.perfect_money_withdraw_max_amount' => '',
            'gateway.perfect_money_withdraw_fixed_charge' => '',
            'gateway.perfect_money_withdraw_percent_charge' => '',

            'gateway.blockchain_secret' => '',
            'gateway.blockchain_xpub_key' => '',
            'gateway.blockchain_api_key' => '',

            'gateway.blockchain_deposit_min_amount' => '',
            'gateway.blockchain_deposit_max_amount' => '',
            'gateway.blockchain_deposit_fixed_charge' => '',
            'gateway.blockchain_deposit_percent_charge' => '',

            'gateway.blockchain_withdraw_min_amount' => '',
            'gateway.blockchain_withdraw_max_amount' => '',
            'gateway.blockchain_withdraw_fixed_charge' => '',
            'gateway.blockchain_withdraw_percent_charge' => '',

            'gateway.payeer_merchant_id' => '',
            'gateway.payeer_secret' => '',

            'gateway.payeer_deposit_min_amount' => '',
            'gateway.payeer_deposit_max_amount' => '',
            'gateway.payeer_deposit_fixed_charge' => '',
            'gateway.payeer_deposit_percent_charge' => '',

            'gateway.payeer_withdraw_min_amount' => '',
            'gateway.payeer_withdraw_max_amount' => '',
            'gateway.payeer_withdraw_fixed_charge' => '',
            'gateway.payeer_withdraw_percent_charge' => '',

            'gateway.coinbase_api_key' => '',
            'gateway.coinbase_secret' => '',

            'gateway.coinbase_deposit_min_amount' => '',
            'gateway.coinbase_deposit_max_amount' => '',
            'gateway.coinbase_deposit_fixed_charge' => '',
            'gateway.coinbase_deposit_percent_charge' => '',

            'gateway.coinbase_withdraw_min_amount' => '',
            'gateway.coinbase_withdraw_max_amount' => '',
            'gateway.coinbase_withdraw_fixed_charge' => '',
            'gateway.coinbase_withdraw_percent_charge' => '',
        ];

        foreach ($props as $prop => $default) {
            $this->migrator->add($prop, $default);
        }
    }
}
