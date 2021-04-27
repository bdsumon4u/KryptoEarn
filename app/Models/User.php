<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
        'country',
        'city',
        'address',
        'password',
    ];

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
            ->latest();
    }

    public function getValidTillAttribute(): ?Carbon
    {
        if (!$this->membership) {
            return null;
        }

        return $this->membership->valid_till;
    }

    public function getIsMemberAttribute(): bool
    {
        if ($this->valid_till) {
            return !$this->valid_till->isPast();
        }

        return false;
    }

    public function validForFree(): bool
    {
        return $this->memberships()->where('type', 'free')->doesntExist();
    }

    /**
     * @throws \Throwable
     */
    public function purchase(Plan $plan): Membership
    {
        throw_if(!$plan->price && !$this->validForFree(), "You Can't Purchase Free Plan.");

        return $this->memberships()->create([
            'plan_id' => $plan->id,
            'tomorrow' => now()->addDay(),
            'task_limit' => $plan->task_limit,
            'valid_till' => $plan->validityFor($this),
            'type' => $plan->price ? 'premium' : 'free',
        ]);
    }

    /**
     * @throws \Throwable
     */
    public function purchaseFreePlan()
    {
        $freePlan = Plan::query()->firstWhere('price', 0);
        throw_unless($freePlan, "There Is No Free Plan.");
        return $this->purchase($freePlan);
    }
}
