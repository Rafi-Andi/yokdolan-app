<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reward>
 */
class RewardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = $this->faker->randomElement(['Produk Spesial', 'Voucher Diskon Mandiri']);

        return [
            // partner_user_id akan diisi di seeder

            'title' => 'Hadiah ' . $this->faker->word() . ' ' . Str::random(3), // Wajib diisi!
            'description' => $this->faker->paragraph(2), // Wajib diisi!
            'type' => $type, // Wajib diisi!
            'points_cost' => $this->faker->numberBetween(50, 500), // Wajib diisi!
            'voucher_value' => $this->faker->numberBetween(10, 100), // Boleh nullable, tapi diisi
            'is_available' => true,
        ];
    }
}
