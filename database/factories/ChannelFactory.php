<?php

namespace Database\Factories;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    protected $model = Channel::class;

    public function definition()
    {
        return [
            // owner_user_id akan diisi di seeder
            'name' => $this->faker->unique()->city() . ' Adventure',
            'location' => $this->faker->city(),
            'is_active' => true,
        ];
    }
}