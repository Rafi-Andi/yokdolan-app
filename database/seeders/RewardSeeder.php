<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reward;

class RewardSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Gratis' => 800,
            'Diskon' => 500,
            'Bonus'  => 350,
        ];

        $partners = User::with('ekrafPartner')->where('role', 'partner')->get();

        foreach ($partners as $partner) {

            foreach ($types as $type => $pointCost) {

                Reward::create([
                    'partner_user_id' => $partner->id,
                    'title' => "Reward {$type} Produk dari Partner {$partner->ekrafPartner->business_name}",
                    'description' => "Ini adalah reward jenis {$type} yang diberikan oleh partner {$partner->ekrafPartner->business_name}.",
                    'type' => $type,
                    'points_cost' => $pointCost,
                    'reward_photo_path' => "rewards/{$type}.jpg", 
                    'is_available' => 1,
                ]);
            }
        }
    }
}
