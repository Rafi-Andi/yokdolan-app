<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Reward;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Mission;
use App\Models\MissionClaim;
use Illuminate\Http\Request;
use App\Models\TouristProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DashboardTouristController extends Controller
{

    function index()
    {
        $userId = Auth::id();

        $user = User::with('TouristProfile')->find($userId);
        if (!$user || $user->role === 'partner') {
            if ($user && $user->role === 'partner') {
                return redirect()->route('dashboard.ekraf');
            }
        }
        if (!$user || $user->role === 'channel_owner') {
            if ($user && $user->role === 'channel_owner') {
                return redirect()->route('dashboard.channel');
            }
        }

        $Channel = Channel::where('is_verified', true)->withCount('missions')->orderBy('created_at', 'asc')->take(5)->get();
        return Inertia::render('DashboardWisatawan/Index', [
            'user' => $user,
            'channels' => $Channel
        ]);
    }
    function leaderboard()
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Leaderboard');
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
            ->where('is_verified', true)
            ->when($searchQuery, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('location', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('created_at', 'asc')
            ->paginate(5)
            ->withQueryString();

        return Inertia::render('DashboardWisatawan/Wisata', [
            'wisata' => $wisata,
            'filters' => ['search' => $searchQuery],
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
    function hadiah()
    {
        $userId = Auth::id();

        $user = User::with('TouristProfile')->find($userId);
        if (!$user || $user->role === 'partner') {
            if ($user && $user->role === 'partner') {
                return redirect()->route('dashboard.ekraf');
            }
        }

        $rewards = Reward::query()->orderBy('created_at', 'asc')->get();

        return Inertia::render('DashboardWisatawan/Hadiah', [
            'user' => $user,
            'reward' => $rewards
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

        return Inertia::render('DashboardWisatawan/Profile');
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
}
