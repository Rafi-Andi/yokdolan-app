<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ChannelSeeder::class,
            EkrafPartnerSeeder::class,
            MissionSeeder::class,
            RewardSeeder::class,
        ]);
    }
}
