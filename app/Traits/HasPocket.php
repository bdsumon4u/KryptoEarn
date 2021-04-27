<?php

namespace App\Traits;

use Bavix\Wallet\Models\Wallet;
use Bavix\Wallet\Traits\HasWallets;

trait HasPocket
{
    use HasWallets;

    public function pocket(string $wallet = 'default')
    {
        if (!$this->hasWallet($wallet)) {
            return $this->createWallet([
                'name' => $wallet,
                'slug' => $wallet,
            ]);
        }

        return $this->getWallet($wallet);
    }

    public function earningPocket(): Wallet
    {
        return $this->pocket('earning');
    }

    public function purchasedPocket(): Wallet
    {
        return $this->pocket('purchased');
    }

    public function commissionPocket(): Wallet
    {
        return $this->pocket('commission');
    }

    public function bonusPocket(): Wallet
    {
        return $this->pocket('bonus');
    }
}
