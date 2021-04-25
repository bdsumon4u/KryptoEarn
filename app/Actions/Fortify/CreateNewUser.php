<?php

namespace App\Actions\Fortify;

use App\Models\User;
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
        $input += ['country' => ip_info('country', 'N/A')];
        Validator::make($input, [
            'name' => ['required', 'string', 'max:35'],
            'email' => ['required', 'string', 'email', 'max:85', 'unique:users'],
            'username' => ['required', 'string', 'max:20', 'unique:users'],
            'referrer' => ['nullable', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:60'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $data = array_merge($input, [
            'password' => Hash::make($input['password']),
        ]);

        if (!$referrer = User::firstWhere('username', $input['referrer'])) {
            return User::create($data);
        }

        return $referrer->referred()->create($data);
    }
}
