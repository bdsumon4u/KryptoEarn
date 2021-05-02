<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id', 'amount', 'gateway', 'charge', 'payable',
    ];

    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = $amount * 100;
    }
    public function getAmountAttribute($amount)
    {
        return $amount / 100;
    }

    public function setChargeAttribute($amount)
    {
        $this->attributes['charge'] = $amount * 100;
    }
    public function getChargeAttribute($amount)
    {
        return $amount / 100;
    }

    public function setPayableAttribute($amount)
    {
        $this->attributes['payable'] = $amount * 100;
    }
    public function getPayableAttribute($amount)
    {
        return $amount / 100;
    }
}
