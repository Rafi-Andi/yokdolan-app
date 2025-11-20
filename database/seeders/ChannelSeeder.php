<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Channel;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChannelSeeder extends Seeder
{
    public function run(): void
    {
        $owners = User::where('role', 'channel_owner')->get();

        $wisataList = [
            [
                'name' => 'Gunung Bromo',
                'location' => 'Probolinggo, Jawa Timur',
                'description' => 'Wisata pegunungan dengan sunrise terbaik dan lautan pasir yang ikonik.',
                'phone' => '081234500001',
                'profile_photo_path' => 'channels/bromo.jpg',
                'is_verified' => 1,
                'is_active' => 0,
            ],
            [
                'name' => 'Kawah Ijen',
                'location' => 'Banyuwangi, Jawa Timur',
                'description' => 'Fenomena api biru dan kawah asam terbesar di dunia.',
                'phone' => '081234500002',
                'profile_photo_path' => 'channels/kawah_ijen.jpg',
                'is_verified' => 1,
                'is_active' => 1,
            ],
            [
                'name' => 'Pantai Klayar',
                'location' => 'Pacitan, Jawa Timur',
                'description' => 'Pantai dengan seruling samudera dan karang eksotis.',
                'phone' => '081234500003',
                'profile_photo_path' => 'channels/klayar.jpg',
                'is_verified' => 1,
                'is_active' => 0,
            ],
            [
                'name' => 'Coban Rondo',
                'location' => 'Batu, Jawa Timur',
                'description' => 'Air terjun populer dengan area hutan yang sejuk.',
                'phone' => '081234500004',
                'profile_photo_path' => 'channels/coban_rondo.jpg',
                'is_verified' => 0,
                'is_active' => 0,
            ],
            [
                'name' => 'Taman Nasional Baluran',
                'location' => 'Situbondo, Jawa Timur',
                'description' => 'Dikenal sebagai Africa van Java dengan savana luas.',
                'phone' => '081234500005',
                'profile_photo_path' => 'channels/baluran.jpg',
                'is_verified' => 1,
                'is_active' => 1,
            ],
        ];

        $data = [];

        foreach ($owners as $index => $owner) {
            if (!isset($wisataList[$index])) {
                break; 
            }

            $wisata = $wisataList[$index];

            $data[] = [
                'owner_user_id' => $owner->id,
                'name' => $wisata['name'],
                'location' => $wisata['location'],
                'description' => $wisata['description'],
                'phone' => $wisata['phone'],
                'profile_photo_path' => $wisata['profile_photo_path'],
                'is_verified' => $wisata['is_verified'],
                'is_active' => $wisata['is_active'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        DB::table('channels')->insert($data);
    }
}
