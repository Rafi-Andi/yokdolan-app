<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('users')->insert([
            [
                'name' => 'Admin Utama',
                'email' => 'admin@yokdolan.com',
                'profile_url' => 'profiles/admin.jpg',
                'password' => Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'role' => 'admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Pemilik Channel A',
                'email' => 'owner@yokdolan.com',
                'profile_url' => 'profiles/owner.jpg',
                'password' => Hash::make('password'),
                'two_factor_secret' => Str::random(32),
                'two_factor_recovery_codes' => json_encode([Str::random(10), Str::random(10)]),
                'two_factor_confirmed_at' => Carbon::now(),
                'role' => 'channel_owner',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Partner Ekraft A',
                'email' => 'partner@yokdolan.com',
                'profile_url' => 'profiles/partner.jpg',
                'password' => Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'role' => 'partner',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'User Wisatawan',
                'email' => 'tourist@yokdolan.com',
                'profile_url' => 'profiles/tourist.jpg',
                'password' => Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'role' => 'tourist',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        $channelOwners = [];
        for ($i = 0; $i < 10; $i++) {
            $channelOwners[] = [
                'name' => $faker->name(),
                'email' => 'owner'.$i.'@yokdolan.com',
                'profile_url' => 'profiles/channel_owner_'.$i.'.jpg',
                'password' => Hash::make('password'),
                'two_factor_secret' => Str::random(32),
                'two_factor_recovery_codes' => json_encode([Str::random(10), Str::random(10)]),
                'two_factor_confirmed_at' => Carbon::now(),
                'role' => 'channel_owner',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('users')->insert($channelOwners);

        $partners = [];
        for ($i = 0; $i < 15; $i++) { 
            $partners[] = [
                'name' => $faker->name(),
                'email' => 'partner'.$i.'@yokdolan.com',
                'profile_url' => 'profiles/partner_'.$i.'.jpg',
                'password' => Hash::make('password'),
                'two_factor_secret' => null,
                'two_factor_recovery_codes' => null,
                'two_factor_confirmed_at' => null,
                'role' => 'partner',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        DB::table('users')->insert($partners);
    }
}
