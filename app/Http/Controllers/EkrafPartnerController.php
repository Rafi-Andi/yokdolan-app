<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Reward;
use App\Models\Mission;
use App\Models\EkrafPartner;
use Illuminate\Http\Request;
use App\Models\RewardExchange;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EkrafPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
