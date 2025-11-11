<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Channel;
use App\Models\TouristProfile;
use App\Models\EkrafPartner;
use App\Models\Mission;
use App\Models\Reward;
use App\Models\MissionClaim;
use App\Models\RewardExchange;
use App\Models\PointHistory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class YokDolanSeeder extends Seeder
{
    public function run(): void
    {
        // 1. --- BUAT ROLE USER DASAR UNTUK TESTING LOGIN ---
        
        // Admin (Channel Owner)
        $adminUser = User::create([
            'name' => 'Admin Owner Jatim',
            'email' => 'admin@yokdolan.com',
            'password' => Hash::make('password'),
            'role' => 'channel_owner',
        ]);

        // Mitra Kunci (Verified) - Login ini harus bekerja!
        $partnerUser = User::create([
            'name' => 'Mitra Kopi Lonceng',
            'email' => 'mitra@yokdolan.com',
            'password' => Hash::make('password'),
            'role' => 'partner',
        ]);

        // Wisatawan Kunci - Login ini harus bekerja!
        $touristUser = User::create([
            'name' => 'Budi Sang Petualang',
            'email' => 'tourist@yokdolan.com',
            'password' => Hash::make('password'),
            'role' => 'tourist',
        ]);
        
        // 2. --- BUAT SAMPLE DATA MASSAL & PROFILE ---
        
        // Channel
        $channels = Channel::factory(3)->create(['owner_user_id' => $adminUser->id]);
        $channelKunci = $channels->first();

        // Mitra Massal (menggunakan state partner() di Factory)
        $partnerUsersMassal = User::factory(7)->partner()->create()->each(function ($user) use ($channels) {
            $user->ekrafPartner()->create(EkrafPartner::factory()->make([
                'channel_id' => $channels->random()->id,
                'is_verified' => true,
            ])->toArray());
        });

        // Mitra Kunci Ekraf
        $partnerKopi = EkrafPartner::create([
            'user_id' => $partnerUser->id,
            'channel_id' => $channelKunci->id,
            'business_name' => 'Toko Kopi Lonceng Kunci',
            'business_address' => 'Jl. Kunci Testing No. 10',
            'is_verified' => true,
        ]);

        // Wisatawan Massal (menggunakan state tourist() di Factory)
        $touristUsersMassal = User::factory(10)->tourist()->create();
        $allTouristUsers = $touristUsersMassal->merge(User::where('role', 'tourist')->get());

        // Tourist Profile
        $allTouristUsers->each(function ($user) {
            $user->touristProfile()->create(TouristProfile::factory()->make([
                'point_akumulasi' => rand(800, 1500),
                'point_value' => rand(500, 1000),
            ])->toArray());
        });
        
        // 3. --- BUAT MISI & REWARD KUNCI ---

        // Misi Kunci (oleh Mitra Kopi Lonceng Kunci)
        $missionKopi = Mission::create([
            'partner_user_id' => $partnerUser->id,
            'channel_id' => $channelKunci->id,
            'title' => 'Cicipi Kopi Klasik (Test Kunci)',
            'description' => 'Beli satu gelas kopi tubruk khas Lonceng dan dapatkan 400 poin.',
            'type' => 'Transaksi',
            'reward_points' => 400,
            'qr_code_unique_id' => 'QR-KPLN-' . Str::random(5), 
        ]);
        
        // Reward Kunci (Voucher Diskon Kopi)
        $rewardKopi = Reward::create([
            'partner_user_id' => $partnerUser->id,
            'title' => 'Voucher Diskon 50% Gelas Kedua',
            'description' => 'Diskon 50% untuk pembelian gelas kedua.',
            'type' => 'Voucher Diskon Mandiri',
            'points_cost' => 300, 
            'voucher_value' => 50.00,
        ]);
        
        // Misi dan Reward Massal
        $partnerIds = EkrafPartner::where('is_verified', true)->pluck('user_id');
        $channelsIds = $channels->pluck('id');

        foreach ($partnerIds as $partnerId) {
            Mission::factory(rand(2, 5))->create([
                'partner_user_id' => $partnerId,
                'channel_id' => $channelsIds->random(),
            ]);
            
            Reward::factory(rand(1, 3))->create([
                'partner_user_id' => $partnerId,
            ]);
        }
        
        // 4. --- SIMULASI TRANSAKSI KUNCI (TESTING LOGIC) ---
        
        // Tourist Budi mengklaim Misi Kopi (Testing Klaim)
        $claim = MissionClaim::create([
            'tourist_user_id' => $touristUser->id,
            'mission_id' => $missionKopi->id,
            'claimed_at' => now(),
        ]);
        
        // Update Poin Budi (Simulasi Logic Controller Klaim)
        $profileBudi = $touristUser->touristProfile;
        $profileBudi->point_akumulasi += $missionKopi->reward_points;
        $profileBudi->point_value += $missionKopi->reward_points;
        $profileBudi->save();

        // Tourist Budi menukar Reward Kopi (Testing Redeem)
        $rewardExchange = RewardExchange::create([
            'tourist_user_id' => $touristUser->id,
            'reward_id' => $rewardKopi->id,
            'exchange_at' => now(),
            'validation_status' => 'validated', 
            'validated_by_partner_id' => $partnerUser->id,
            'validated_at' => now(),
        ]);
        
        // Update Poin Budi (Simulasi Logic Controller Redeem)
        // Pengecekan saldo dilakukan di Controller, di sini hanya update
        if ($profileBudi->point_value >= $rewardKopi->points_cost) {
             $profileBudi->point_value -= $rewardKopi->points_cost;
             $profileBudi->save();
        }
    }
}