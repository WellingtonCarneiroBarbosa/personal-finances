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
     * @param  array  $settings
     * @return \App\Models\User
     */
    public function create(array $input, array $settings = []): User
    {
        $validatedInput = Validator::make($input, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms'    => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name'     => $validatedInput['name'],
            'email'    => $validatedInput['email'],
            'password' => Hash::make($validatedInput['password']),
        ]);

        if (! count($settings) === 0) {
            $user->settings->fill($settings)->update();
        }

        return $user;
    }
}
