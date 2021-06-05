<?php

namespace App\Actions\Fortify;

use App\Models\Admin;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    private function rules($user): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', $this->unique($user)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ];

        if ($user instanceof Admin) {
            return $rules;
        }

        return array_merge($rules, [
            'phone' => ['required', 'string', 'max:20', $this->unique($user)],
            'city' => ['required', 'string', 'max:60'],
            'road_no' => ['nullable', 'string', 'max:25'],
            'postal_code' => ['required', 'string', 'max:25'],
            'language' => ['required', 'string', 'max:25'],
            'address' => ['required', 'string', 'max:255'],
        ]);
    }

    private function validatedData($user, array $input): array
    {
        return Validator::make($input, $this->rules($user))
            ->validateWithBag('updateProfileInformation');
    }

    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        $data = $this->validatedData($user, $input);

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $data);
        } else {
            $user->forceFill($data)->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill($input + [
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    public function unique($user)
    {
        return Rule::unique('users')->ignore($user->id);
    }
}
