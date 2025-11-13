<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Mission;
use Illuminate\Http\Request;
use App\Models\TouristProfile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DashboardTouristController extends Controller
{
    function index()
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Index');
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
    function wisata()
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Wisata');
    }
    function misi()
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Misi');
    }
    function detailmisi()
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/DetailMisi');
    }
    function hadiah()
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Hadiah');
    }
    function detailhadiah()
    {
        $user = Auth::user();
        if ($user->role === 'partner') {
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/DetailHadiah');
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


        $rewardPoints = (int) $Mission->reward_points;

        $userId = $user->id;

        Log::info('Scan Debug:', [
            'user_id' => $user->id,
            'mission_id' => $Mission->id,
            'reward_points_from_mission' => $rewardPoints,
            'initial_point_akumulasi' => $touristProfile->point_akumulasi ?? 'N/A',
            'initial_point_value' => $touristProfile->point_value ?? 'N/A',
            'raw_query_point_value' => "point_value + " . $rewardPoints
        ]);


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

                return redirect()->route('dashboard')->with('message', 'Misi berhasil diselesaikan! Poin ditambahkan.');
            } else {
                return back()->withErrors(['qr_code' => 'Poin tidak bertambah. Pastikan field point_value bertipe numerik.']);
            }
        } catch (\Exception $e) {
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
