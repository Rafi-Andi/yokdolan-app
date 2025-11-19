<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mission;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;

class MissionSeeder extends Seeder
{
    private const REWARD_POINTS_MAP = [
        'Interaksi' => 700,
        'Promosi' => 500,
        'Transaksi' => 300,
    ];

    public function run(): void
    {
        $faker = Faker::create();

        Storage::disk('public')->makeDirectory('qrcodes');
        Storage::disk('public')->makeDirectory('missions');

        $partners = User::where('role', 'partner')
            ->whereHas('ekrafPartner')
            ->with('ekrafPartner')
            ->get();

        foreach ($partners as $partner) {

            $channelId = $partner->ekrafPartner->channel_id;

            $missionCount = rand(1, 3);

            for ($i = 0; $i < $missionCount; $i++) {

                $type = $faker->randomElement(['Transaksi', 'Interaksi', 'Promosi']);
                $rewardPoints = self::REWARD_POINTS_MAP[$type];

                $uniqueId = 'QR-' . strtoupper(Str::random(10));

                $qrFileName = "qrcodes/mission-{$uniqueId}.png";

                $builder = new Builder(
                    writer: new PngWriter(),
                    data: $uniqueId,
                    encoding: new Encoding('UTF-8'),
                    size: 300,
                    margin: 10
                );

                $result = $builder->build();

                Storage::disk('public')->put($qrFileName, $result->getString());

                Mission::create([
                    'partner_user_id' => $partner->id,
                    'channel_id' => $channelId,
                    'title' => $faker->sentence(4),
                    'description' => $faker->paragraph(),
                    'type' => $type,
                    'reward_points' => $rewardPoints,
                    'mission_photo_path' => 'missions/default.png',
                    'qr_code_unique_id' => $uniqueId,
                    'qr_code_path' => $qrFileName,
                    'is_active' => true,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
        }
    }
}
