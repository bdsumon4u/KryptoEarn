<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx_id', 'amount', 'gateway', 'charge', 'receivable',
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

    public function setReceivableAttribute($amount)
    {
        $this->attributes['receivable'] = $amount * 100;
    }
    public function getReceivableAttribute($amount)
    {
        return $amount / 100;
    }
}
