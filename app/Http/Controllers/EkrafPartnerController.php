<?php

namespace App\Http\Controllers;

use App\Models\RewardExchange;
use Inertia\Inertia;
use App\Models\Reward;
use App\Models\Mission;
use App\Models\EkrafPartner;
use Illuminate\Http\Request;
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

    /**
     * Show the form for creating a new resource.
     */
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
