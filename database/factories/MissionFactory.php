<?php

namespace Database\Factories;

use App\Models\Mission;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MissionFactory extends Factory
{
    protected $model = Mission::class;

    public function definition()
    {
        $type = $this->faker->randomElement(['Transaksi', 'Interaksi']);
        $points = $this->faker->numberBetween(50, 250);

        return [
            // partner_user_id dan channel_id akan diisi di seeder
            'title' => ($type === 'Transaksi' ? 'Beli ' : 'Belajar ') . $this->faker->word() . ' Lokal',
            'description' => $this->faker->paragraph(2),
            'type' => $type,
            'reward_points' => $points,
            'qr_code_unique_id' => Str::random(10) . time(),
            'is_active' => true,
        ];
    }
}