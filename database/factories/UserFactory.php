<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => $this->faker->randomElement(['tourist', 'partner']), // Default random role
        ];
    }
    
    // --- TAMBAHAN WAJIB UNTUK MENGHILANGKAN ERROR ---
    
    /**
     * Indicate that the user is a Partner.
     */
    public function partner(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'partner',
        ]);
    }
    
    /**
     * Indicate that the user is a Tourist.
     */
    public function tourist(): Factory
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'tourist',
        ]);
    }
}