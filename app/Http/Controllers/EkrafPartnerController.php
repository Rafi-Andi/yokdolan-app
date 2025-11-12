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

    public function createMission()
    {
        return Inertia::render('DashboardEkraf/AddMission');
    }
    public function createReward()
    {
        return Inertia::render('DashboardEkraf/AddReward');
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

    public function storeMission(Request $request)
    {
        $user = Auth::user();

        if ($user->role !== 'partner') {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
        }

        $channelId = $user->ekrafPartner->channel_id;

        // 1. Validasi Input Form
        $data = $request->validate([
            'title' => 'required|string|max:128',
            'description' => 'required|string',
            'type' => 'required|string|in:Transaksi,Interaksi,Promosi', // Asumsi tipe hanya 2 ini
            'reward_points' => 'required|integer|min:1',
        ]);

        $uniqueId = 'QR-' . Str::upper(Str::random(10));
        $qrContentUrl = url("/mission/validate/{$uniqueId}"); // URL endpoint validasi
        $fileName = 'qrcodes/mission-' . $uniqueId . '.png';

        try {
            // 2. Generate QR Code menggunakan Builder yang terbukti berhasil (Pola Named Arguments)
            $builder = new Builder(
                writer: new PngWriter(),
                data: $qrContentUrl,
                encoding: new Encoding('UTF-8'),
                size: 300,
                margin: 10
            );
            $result = $builder->build();

            // 3. Simpan Gambar QR Code ke Storage
            Storage::disk('public')->put($fileName, $result->getString());

            // 4. Buat Entri Misi di Database
            Mission::create([
                'partner_user_id' => $user->id,
                'channel_id' => $channelId, // Mengambil Channel ID dari form
                'title' => $data['title'],
                'description' => $data['description'],
                'type' => $data['type'],
                'reward_points' => $data['reward_points'],
                'qr_code_unique_id' => $uniqueId,
                'qr_code_path' => $fileName, // Menyimpan path file
                'is_active' => true,
            ]);

            return redirect()->route('dashboard.ekraf.mission')
                ->with('success', 'Misi dan QR Code berhasil dibuat dan siap digunakan!');
        } catch (\Exception $e) {
            // Tangani kegagalan penyimpanan QR Code (misal: ekstensi GD bermasalah)
            return back()->with('error', 'Gagal membuat Misi. Error: ' . $e->getMessage());
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
