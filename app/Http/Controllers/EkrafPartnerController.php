<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Reward;
use App\Models\Mission;
use Endroid\QrCode\QrCode;
use Illuminate\Support\Str;
use App\Models\EkrafPartner;
use Illuminate\Http\Request;
use App\Models\RewardExchange;
use Illuminate\Support\Facades\DB;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;
use Endroid\QrCode\Encoding\Encoding;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\Builder\Builder;


class EkrafPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function generateQr()
    {
        $testId = 'TEST-' . Str::random(5);
        $testContent = 'http://127.0.0.1:8000/mission/validate/' . $testId;

        try {
            // ✅ KODE YANG BERHASIL: Menggunakan Builder constructor dengan named arguments
            $builder = new Builder(
                writer: new PngWriter(),
                data: $testContent,
                encoding: new Encoding('UTF-8'),
                size: 300,
                margin: 10
            );

            // ✅ 2. Build QR Code
            $result = $builder->build();

            $fileName = 'qrcodes/test-qr-' . $testId . '.png';

            // ✅ 4. Simpan hasil QR ke storage
            Storage::disk('public')->put($fileName, $result->getString());

            // ✅ 5. Pastikan symlink ada
            if (!file_exists(public_path('storage'))) {
                Artisan::call('storage:link');
            }

            // ✅ 6. Kembalikan URL hasil
            $url = asset('storage/' . $fileName);
            return response("✅ SUCCESS: QR Code berhasil dibuat dan disimpan di: 
            <a href='{$url}' target='_blank'>{$url}</a><br>
            Cek folder 'storage/app/public/qrcodes'.", 200);
        } catch (\Exception $e) {
            return response("❌ FAILURE: Gagal membuat QR Code. Error: " . $e->getMessage(), 500);
        }
    }
    public function index()
    {
        $user = Auth::user();

        $partnerId = $user->id;
        if ($user->role !== 'partner') {
            return redirect()->route('dashboard');
        }
        $partnerRewardIds = Reward::where('partner_user_id', $partnerId)->pluck('id');
        $totalPoints = Mission::query()
            ->where('partner_user_id', $partnerId)
            ->join('mission_claims', 'missions.id', '=', 'mission_claims.mission_id')
            ->sum('reward_points');

        $totalRedeemed = Reward::query()
            ->where('partner_user_id', $partnerId)
            ->join('reward_exchanges', 'rewards.id', '=', 'reward_exchanges.reward_id')
            ->where('reward_exchanges.validation_status', 'validated')
            ->count('reward_exchanges.id');

        $pendingValidations = RewardExchange::query()
            ->whereIn('reward_id', $partnerRewardIds)->where('validation_status', '=', 'pending')
            ->with(['reward:id,title', 'tourist:id,name'])->orderBy('exchange_at', 'asc')
            ->get();;

        return Inertia::render('DashboardEkraf/Index', [
            'stats' => [
                'total_points_spent' => $totalPoints,
                'total_missions_redeemed' => $totalRedeemed,
            ],
            'pendingValidations' => $pendingValidations
        ]);
    }

    public function getAllRewards()
    {
        $user = Auth::user();

        $partnerId = $user->id;
        if ($user->role !== 'partner') {
            return redirect()->route('dashboard');
        }

        $rewards = Reward::query()->where('partner_user_id', '=', $partnerId)->orderBy('created_at', 'asc')->get();

        return Inertia::render('DashboardEkraf/Rewards', [
            "rewards" => $rewards
        ]);
    }

    public function getDetailRewards($id)
    {
        $user = Auth::user();

        $partnerId = $user->id;
        if ($user->role !== 'partner') {
            return redirect()->route('dashboard');
        }

        $rewards = Reward::query()->where('partner_user_id', '=', $partnerId)->where('id', $id)->firstOrFail();        
        return Inertia::render('DashboardEkraf/DetailRewards', [
            "detail" => $rewards
        ]);
    }

    public function getAllMissions()
    {
        $user = Auth::user();

        $partnerId = $user->id;
        if ($user->role !== 'partner') {
            return redirect()->route('dashboard');
        }

        $missions = Mission::query()->where('partner_user_id', '=', $partnerId)->orderBy('created_at', 'asc')->get();
        return Inertia::render('DashboardEkraf/Missions', [
            "missions" => $missions
        ]);
    }

    public function getDetailMission($id)
    {
        $user = Auth::user();

        $partnerId = $user->id;
        if ($user->role != 'partner') {
            return redirect()->route('dashboard');
        }

        $mission = Mission::query()->where('partner_user_id', '=', $partnerId)->where('id', $id)->firstOrFail();

        return Inertia::render('DashboardEkraf/DetailMisi', [
            "detail" => $mission
        ]);
    }

    public function createMission()
    {
        $pointMap = [
            'Transaksi' => 300,
            'Interaksi' => 700,
            'Promosi' => 500,
        ];
        return Inertia::render('DashboardEkraf/AddMission', [
            'pointMap' => $pointMap
        ]);
    }
    public function createReward()
    {
        $pointMap = [
            'Gratis' => 800,
            'Diskon' => 500,
            'Bonus' => 350,
        ];

        return Inertia::render('DashboardEkraf/AddReward', [
            'pointMap' => $pointMap
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */

    public function validateAllPending(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'partner') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak. Anda bukan Mitra Ekraf.');
        }

        $partnerId = $user->id;

        $partnerRewardIds = Reward::where('partner_user_id', $partnerId)->pluck('id');

        if ($partnerRewardIds->isEmpty()) {
            return back()->with('warning', 'Anda belum memiliki daftar Reward yang terdaftar.');
        }

        $count = 0;

        try {
            DB::transaction(function () use ($partnerId, $partnerRewardIds, &$count) {

                $updates = RewardExchange::whereIn('reward_id', $partnerRewardIds)
                    ->where('validation_status', 'pending')
                    ->update([
                        'validation_status' => 'validated',
                        'validated_by_partner_id' => $partnerId,
                        'validated_at' => now(),
                    ]);

                $count = $updates;
            });

            if ($count > 0) {
                return redirect()->route('dashboard.ekraf')
                    ->with('success', "Berhasil memvalidasi $count penukaran reward pending.");
            } else {
                return back()->with('info', 'Tidak ada antrian validasi reward yang tertunda saat ini.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Validasi gagal karena masalah sistem. Coba lagi nanti.');
        }
    }

    private const REWARD_POINTS_MAP = [
        'Interaksi' => 700,
        'Promosi' => 500,
        'Transaksi' => 300,
    ];
    public function storeMission(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'partner') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $channelId = $user->ekrafPartner->channel_id;

        $data = $request->validate([
            'title' => 'required|string|max:128',
            'description' => 'required|string',
            'type' => 'required|string|in:Transaksi,Interaksi,Promosi',
            'mission_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
        ]);

        $rewardPoints = self::REWARD_POINTS_MAP[$data['type']] ?? 0;

        if ($rewardPoints === 0) {
            return back()->with('error', 'Tipe misi yang dipilih tidak memiliki nilai poin.');
        }

        $uniqueId = 'QR-' . Str::upper(Str::random(10));
        $qrContentUrl = $uniqueId;

        $qrFileName = 'qrcodes/mission-' . $uniqueId . '.png';
        $missionPhotoPath = null;

        try {
            if ($request->hasFile('mission_photo')) {
                $file = $request->file('mission_photo');
                $missionPhotoPath = $file->store('missions', 'public');
            }

            $builder = new Builder(
                writer: new PngWriter(),
                data: $qrContentUrl,
                encoding: new Encoding('UTF-8'),
                size: 300,
                margin: 10
            );
            $result = $builder->build();

            Storage::disk('public')->put($qrFileName, $result->getString());

            Mission::create([
                'partner_user_id' => $user->id,
                'channel_id' => $channelId,
                'title' => $data['title'],
                'description' => $data['description'],
                'type' => $data['type'],
                'reward_points' => $rewardPoints,
                'mission_photo_path' => $missionPhotoPath,
                'qr_code_unique_id' => $uniqueId,
                'qr_code_path' => $qrFileName,
                'is_active' => true,
            ]);

            return redirect()->route('dashboard.ekraf.mission')
                ->with('success', 'Misi dan QR Code berhasil dibuat dan siap digunakan!');
        } catch (\Exception $e) {
            if ($missionPhotoPath) {
                Storage::disk('public')->delete($missionPhotoPath);
            }
            return back()->with('error', 'Gagal membuat Misi. Error: ' . $e->getMessage());
        }
    }

    private const REWARD_POINT_COST = [
        'Gratis' => 800,
        'Diskon' => 500,
        'Bonus' => 350,
    ];
    public function storeReward(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'partner') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $partnerId = $user->id;

        $data = $request->validate([
            "title" => "required|string|min:4",
            "description" => "required|string|min:8",
            "type" => "required|string|in:Diskon,Gratis,Bonus",
            "reward_photo" => "required|image|mimes:jpeg,png,jpg,webp|max:1000"
        ]);

        try {
            $photoPath = null;

            if ($request->hasFile('reward_photo')) {
                $file = $request->file('reward_photo');
                $photoPath = $file->store('rewards', 'public');
            }

            $pointCost = self::REWARD_POINT_COST[$data['type']] ?? 0;

            if ($pointCost === 0) {
                return back()->with('error', 'Tipe misi yang dipilih tidak memiliki nilai poin.');
            }

            $reward = Reward::create([
                'partner_user_id' => $partnerId,
                'title' => $data['title'],
                'description' => $data['description'],
                'type' => $data['type'],
                'points_cost' => $pointCost,
                'reward_photo_path' => $photoPath,
                'is_available' => 1,
            ]);

            return redirect()->route('dashboard.ekraf.reward')
                ->with('success', 'Hadiah berhasil dibuat dan siap digunakan!');
        } catch (\Exception $e) {
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }
            return back()->with('error', 'Gagal membuat Hadiah. Error: ' . $e->getMessage());
        }
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EkrafPartner $ekrafPartner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EkrafPartner $ekrafPartner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EkrafPartner $ekrafPartner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EkrafPartner $ekrafPartner)
    {
        //
    }
}
