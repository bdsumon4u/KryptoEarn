<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input + ['country' => 'Bangladesh', 'timezone' => 'Asia/Dhaka'], [
            'name' => ['required', 'string', 'max:35'],
            'email' => ['required', 'string', 'email', 'max:85', 'unique:users'],
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'referrer' => ['nullable', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:60'],
            'timezone' => ['required', 'string', 'max:60'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $data = array_merge($input, [
            'password' => Hash::make($input['password']),
        ]);

        DB::beginTransaction();
        if (!$referrer = User::firstWhere('username', $input['referrer'])) {
            $user = User::create($data);
        } else {
            $user = $referrer->referred()->create($data);
        }

        $user->purchaseFreePlan();
        DB::commit();

        return $user;
    }
}
