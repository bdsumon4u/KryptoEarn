<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected static function boot()
    {
        parent::boot();

        static::saved(function () {
            Cache::tags(['plans'])->flush();
        });
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function validityFor(User $user): Carbon
    {
        return $user->is_member
            ? $user->valid_till->addDays($this->validity)
            : now()->addDays($this->validity);
    }

}
