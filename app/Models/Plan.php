<?php

namespace App\Models;

use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Interfaces\Product;
use Bavix\Wallet\Traits\HasWalletFloat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Plan extends Model implements Product
{
    use HasFactory;
    use HasWalletFloat;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            Cache::tags(['plans'])->flush();
        });
    }

    public function canBuy(Customer $customer, int $quantity = 1, bool $force = null): bool
    {
        /**
         * If the service can be purchased once, then
         *  return !$customer->paid($this);
         */

        if (!$this->price) {
            return !$customer->paid($this);
        }

        return $customer->balance >= $this->getAmountProduct($customer) * $quantity;
    }

    public function getAmountProduct(Customer $customer)
    {
        return $this->price * 100;
    }

    public function getMetaProduct(): ?array
    {
        return [
            'name' => $this->name,
            'description' => 'Upgrade Plan #' . $this->name,
        ];
    }

    public function getUniqueId(): string
    {
        return (string)$this->getKey();
    }
}
