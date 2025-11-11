<?php

namespace Database\Factories;

use App\Models\TouristProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class TouristProfileFactory extends Factory
{
    protected $model = TouristProfile::class;

    public function definition()
    {
        return [
            'point_akumulasi' => $this->faker->numberBetween(500, 5000),
            'point_value' => $this->faker->numberBetween(100, 2000),
            'digital_badges' => '[]', 
        ];
    }
}