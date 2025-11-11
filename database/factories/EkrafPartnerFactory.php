<?php

namespace Database\Factories;

use App\Models\EkrafPartner;
use Illuminate\Database\Eloquent\Factories\Factory;

class EkrafPartnerFactory extends Factory
{
    protected $model = EkrafPartner::class;

    public function definition()
    {
        return [
            // user_id dan channel_id akan diisi di seeder
            'business_name' => $this->faker->unique()->company() . ' Craft & Cafe',
            'business_address' => $this->faker->address(),
            'is_verified' => $this->faker->boolean(80), // 80% verified
        ];
    }
}