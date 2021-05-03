<?php

namespace App\Models;

use App\Traits\HasPocket;
use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Interfaces\Wallet;
use Bavix\Wallet\Interfaces\WalletFloat;
use Bavix\Wallet\Traits\CanPayFloat;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, Wallet, WalletFloat, Customer
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasPocket;
    use CanPayFloat;
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'username',
        'address',
        'city',
        'country',
        'timezone',
        'extra',
        'password',
    ];

    use TwoFactorAuthenticatable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'extra' => 'array',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function referrer()
    {
        return $this->belongsTo(static::class, 'referrer_id');
    }

    public function referred()
    {
        return $this->hasMany(static::class, 'referrer_id');
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function membership()
    {
        return $this->hasOne(Membership::class)
            ->with('plan')
            ->latest();
    }

    public function getValidTillAttribute(): Carbon
    {
        return $this->membership->valid_till ?? now();
    }

    public function getEarningPerTaskAttribute()
    {
        if (!$this->valid_till->isFuture()) {
            return 0;
        }

        return $this->membership->plan->earning_per_task;
    }

    public function getTaskRemainingAttribute()
    {
        if ($this->membership->tomorrow->isFuture()) {
            return 0;
        }

        if (!$this->valid_till->isFuture()) {
            return 0;
        }

        return $this->membership->task_limit - $this->membership->task_completed;
    }

    /**
     * @throws \Throwable
     */
    public function purchase(Plan $plan): Membership
    {
        return $this->memberships()->create([
            'plan_id' => $plan->id,
            'tomorrow' => now(),
            'task_limit' => $plan->task_limit,
            'type' => $plan->price ? 'premium' : 'free',
            'valid_till' => $this->valid_till->addDays($plan->validity),
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function purchaseFreePlan(): Membership
    {
        $freePlan = Plan::query()->firstWhere('price', 0);
        throw_unless($freePlan, "There Is No Free Plan.");
        return $this->purchase($freePlan);
    }

    public function refPlanUpgradeCommission($amount)
    {
        if (!$this->valid_till->isFuture()) {
            return 0;
        }

        # Amount is on dollar.
        return $amount * $this->membership->plan->ref_commission_on_plan_upgrade / 100;
    }

    public function refTaskCompleteCommission($amount)
    {
        if (!$this->valid_till->isFuture()) {
            return 0;
        }

        # Amount is on cent.
        return $amount * $this->membership->plan->ref_commission_on_each_task / 100;
    }

    /**
     * @throws \JsonException
     */
    public function setExtraAttribute($extra): void
    {
        $this->attributes['extra'] = json_encode($extra, JSON_THROW_ON_ERROR);
    }

    public function getIsGatewaySafeAttribute(): bool
    {
        return Carbon::parse($this->extra['gateway']['updated_at'])->addDay()->isPast();
    }

    public function deposits(): HasMany
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdraws(): HasMany
    {
        return $this->hasMany(Withdraw::class);
    }
}
