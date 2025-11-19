<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Channel;
use Faker\Factory as Faker;
use App\Models\EkrafPartner;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkrafPartnerSeeder extends Seeder
{
public function run(): void
    {
        $faker = Faker::create(config('app.faker_locale'));

        $partners = DB::table('users')
            ->where('role', 'partner')
            ->pluck('id')
            ->toArray();

        $channelIds = DB::table('channels')->pluck('id')->toArray();

        $data = [];

        foreach ($partners as $index => $userId) {
            $data[] = [
                'user_id' => $userId,
                'channel_id' => $channelIds[$index % count($channelIds)],
                'business_name' => $faker->company(),
                'business_address' => $faker->address(),
                'phone' => $faker->phoneNumber(),
                'is_verified' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('ekraf_partners')->insert($data);
    }
}