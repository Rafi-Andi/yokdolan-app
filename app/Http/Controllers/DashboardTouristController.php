<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Reward;
use App\Models\Channel;
use App\Models\Mission;
use App\Models\EkrafPartner;
use App\Models\MissionClaim;
use Illuminate\Http\Request;
use App\Models\RewardExchange;
use App\Models\TouristProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DashboardTouristController extends Controller
{

    function index(Request $request) // Inject Request
    {
        $userId = Auth::id();
        $user = User::with('touristProfile')->find($userId);

        if ($user && $user->role !== 'tourist') {
            if ($user->role === 'partner') {
                return redirect()->route('dashboard.ekraf');
            }
            if ($user->role === 'channel_owner') {
                return redirect()->route('dashboard.channel');
            }
            if ($user->role === 'admin') {
                return redirect()->route('dashboard.admin');
            }
        }

        $globalSearchQuery = $request->input('search');
        $missionTypeFilter = $request->input('type');

        $Channel = Channel::query()
            ->where('is_verified', true)->where('is_active', true)
            ->when($globalSearchQuery, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('location', 'like', '%' . $search . '%');
                });
            })
            ->withCount('missions')
            ->orderBy('created_at', 'asc')
            ->take(5)
            ->get();
            
        $Missions = Mission::query()
            ->whereHas('channel', function ($query) {
                $query->where('is_verified', true);
            })
            ->with('channel')
            ->when($globalSearchQuery, function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->when($missionTypeFilter, function ($query, $type) {
                $query->where('type', $type);
            })
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();

        return Inertia::render('DashboardWisatawan/Index', [
            'user' => $user,
            'channels' => $Channel,
            'missions' => $Missions,
            'filters' => [
                'search' => $globalSearchQuery,
                'type' => $missionTypeFilter
            ]
        ]);
    }
    function leaderboard()
    {
        $user = Auth::user();

        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        $leaderboardQuery = TouristProfile::query()
            ->join('users', 'tourist_profiles.user_id', '=', 'users.id')

            ->leftJoin('mission_claims', 'tourist_profiles.user_id', '=', 'mission_claims.tourist_user_id')

            ->groupBy(
                'tourist_profiles.user_id',
                'users.name',
                'users.profile_url',
                'tourist_profiles.point_akumulasi',
                'tourist_profiles.point_value'
            )

            ->where('point_akumulasi', '>', 0)

            ->orderBy('point_akumulasi', 'desc')
            ->limit(100)

            ->select(
                'tourist_profiles.user_id',
                'tourist_profiles.point_value',
                'tourist_profiles.point_akumulasi',
                'users.profile_url',
                'users.name',
                DB::raw('COUNT(mission_claims.id) AS missions_completed')
            )
            ->get();


        $currentUserStats = TouristProfile::where('user_id', $user->id)
            ->select('point_akumulasi', 'point_value')
            ->first();

        $currentUserMissionsCompleted = MissionClaim::where('tourist_user_id', $user->id)->count();

        $userAkumulasiPoints = $currentUserStats->point_akumulasi ?? 0;
        $rankQuery = TouristProfile::where('point_akumulasi', '>', $userAkumulasiPoints)->count();
        $userRank = $rankQuery + 1;


        return Inertia::render('DashboardWisatawan/Leaderboard', [
            'leaderboardData' => $leaderboardQuery,
            'currentUser' => [
                'name' => $user->name,
                'profile_url' => $user->profile_url,
                'totalPoints' => $userAkumulasiPoints,
                'misiSelesai' => $currentUserMissionsCompleted,
                'rank' => $userRank,
            ]
        ]);
    }
    function scan()
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Scan');
    }
    public function wisata(Request $request)
    {
        $user = Auth::user();

        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        $searchQuery = $request->input('search');

        $wisata = Channel::query()
            ->where('is_verified', true)->where('is_active', true)
            ->when($searchQuery, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('location', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();



        return Inertia::render('DashboardWisatawan/Wisata', [
            'wisata' => $wisata,
            'filters' => ['search' => $searchQuery],
            'user' =>  $user    
        ]);
    }
    function misi($id)
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        $channel = Channel::find($id);

        if (!$channel) {
            return redirect()->route('dashboard.wisatawan.wisata')->with('error', 'Channel tidak ditemukan.');
        }

        $missions = $channel->missions()
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('DashboardWisatawan/Misi', [
            'channel' => $channel,
            'missions' => $missions,
        ]);
    }
    function detailmisi($id)
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        $mission = Mission::with(['channel', 'ekrafPartner.ekrafPartner'])->find($id);

        return Inertia::render('DashboardWisatawan/DetailMisi', [
            'mission' => $mission,
        ]);
    }

    function hadiah(Request $request)
    {
        $userId = Auth::id();
        $user = User::with('touristProfile')->find($userId);

        if (!$user || $user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        $partnerId = $request->partner_id ? (int) $request->partner_id : null;
        $type = $request->type ?: null;
        $search = $request->search ?: null;

        $query = Reward::query()->with(['ekrafPartner', 'partnerUser']);

        if ($search) {
            $query->where('title', 'like', "%{$search}%");
        }

        if ($type) {
            $query->where('type', $type);
        }

        if ($partnerId) {
            $query->where('partner_user_id', $partnerId);
        }

        $rewards = $query->orderBy('created_at', 'desc')->paginate(8)->withQueryString();

        $types = Reward::select('type')
            ->distinct()
            ->whereNotNull('type')
            ->where('type', '!=', '')
            ->pluck('type')
            ->values()
            ->toArray();

        $partners = User::whereHas('ekrafPartner')
            ->whereIn('id', function ($query) {
                $query->select('partner_user_id')
                    ->from('rewards')
                    ->whereNotNull('partner_user_id')
                    ->distinct();
            })
            ->with('ekrafPartner')
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'business_name' => $user->ekrafPartner->business_name ?? $user->name
                ];
            })
            ->values()
            ->toArray();

        return Inertia::render('DashboardWisatawan/Hadiah', [
            'user' => $user,
            'reward' => $rewards,
            'types' => $types,
            'partners' => $partners,
            'filters' => [
                'search' => $search,
                'type' => $type,
                'partner_id' => $partnerId,
            ]
        ]);
    }
    function detailhadiah($id)
    {
        $userId = Auth::id();

        $user = User::with('TouristProfile')->find($userId);
        if (!$user || $user->role === 'partner') {
            if ($user && $user->role === 'partner') {
                return redirect()->route('dashboard.ekraf');
            }
        }

        $reward = Reward::query()->where('id', $id)->firstOrFail();
        return Inertia::render('DashboardWisatawan/DetailHadiah', [
            'detail_reward' => $reward,
            'user' => $user
        ]);
    }
    function profile()
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        $touristProfile = TouristProfile::where('user_id', $user->id)->first();

        return Inertia::render('DashboardWisatawan/Profile', [
            "user" => $user,
            "touristProfile" => $touristProfile
        ]);
    }
    public function validateScan(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string|min:10'
        ]);

        $user = Auth::user();
        $scannedCode = $request->input('qr_code');

        $Mission = Mission::where('qr_code_unique_id', $scannedCode)->first();

        if ($Mission === null) {
            return back()->withErrors(['qr_code' => 'Kode QR tidak valid.'])->onlyInput('qr_code');
        }

        $existingClaim = MissionClaim::where('tourist_user_id', $user->id)
            ->where('mission_id', $Mission->id)
            ->first();

        if ($existingClaim) {
            return back()->withErrors(['qr_code' => 'Misi ini sudah pernah Anda klaim sebelumnya.'])->onlyInput('qr_code');
        }


        $rewardPoints = (int) $Mission->reward_points;

        $userId = $user->id;
        DB::beginTransaction();

        TouristProfile::firstOrCreate(
            ['user_id' => $userId],
            [
                'point_akumulasi' => 0,
                'point_value' => 0,
            ]
        );
        try {
            $updateResult = TouristProfile::where('user_id', $userId)->update([
                'point_akumulasi' => DB::raw('point_akumulasi + 100'),
                'point_value' => DB::raw('point_value + ' . $rewardPoints),
            ]);

            if ($updateResult > 0) {
                $MissionClaim = MissionClaim::create([
                    'tourist_user_id' => $userId,
                    'mission_id' => $Mission->id,
                    'claimed_at' => now(),
                ]);

                db::commit();
                return redirect()->route('dashboard')->with('message', 'Misi berhasil diselesaikan! Poin ditambahkan.');
            } else {
                db::rollBack();
                return back()->withErrors(['qr_code' => 'Poin tidak bertambah. Pastikan field point_value bertipe numerik.']);
            }
        } catch (\Exception $e) {
            db::rollBack();
            Log::error('Update Poin Gagal Total:', [
                'user_id' => $user->id,
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return back()->withErrors(['qr_code' => 'Terjadi kesalahan sistem saat menambahkan poin. Silakan cek log server.']);
        }
    }

    public function rewardReedem($id)
    {
        $user = Auth::user();

        $reward = Reward::find($id);
        if (!$reward) {
            return back()->withErrors(['reward' => 'Hadiah tidak ditemukan.']);
        }

        $touristProfile = TouristProfile::where('user_id', $user->id)->first();
        if (!$touristProfile || $touristProfile->point_value < $reward->points_cost) {
            return back()->withErrors(['reward' => 'Poin Anda tidak mencukupi untuk menukar hadiah ini.']);
        }

        DB::beginTransaction();
        try {
            $touristProfile->decrement('point_value', $reward->points_cost);
            $rewardExchange = RewardExchange::create([
                'tourist_user_id' => $user->id,
                'reward_id' => $reward->id,
                'exchange_at' => now(),
                'validation_status' => 'pending',
            ]);

            DB::commit();
            return redirect()->route('dashboard.wisatawan.hadiah')->with('message', 'Hadiah berhasil ditukar!');
        } catch (\Exception $e) {
            DB::rollBack();


            return back()->withErrors(['reward' => 'Terjadi kesalahan sistem saat menukar hadiah.' .  $e->getMessage()]);
        }
    }
}
