<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\TouristProfile; // <<< 1. IMPORT MODEL TOURIST PROFILE
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash; // Tambahkan Hash jika belum ada
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'profile_url' => ['required', 'string'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']), 
            'role' => 'tourist',
            'profile_url' => $input['profile_url'],
        ]);
        
        $user->touristProfile()->create([
            'user_id' => $user->id,
        ]);

        return $user;
    }
}