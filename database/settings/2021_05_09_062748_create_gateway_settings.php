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
            'gateway.blockchain_secret' => '',
            'gateway.blockchain_xpub_key' => '',
            'gateway.blockchain_api_key' => '',
            'gateway.payeer_merchant_id' => '',
            'gateway.payeer_secret' => '',
        ];

        foreach ($props as $prop => $default) {
            $this->migrator->add($prop, $default);
        }
    }
}
