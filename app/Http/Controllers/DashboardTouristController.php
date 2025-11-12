<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTouristController extends Controller
{
    function index(){
        $user = Auth::user();
        if($user->role === 'partner'){
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Index');
    }
    function leaderboard(){
        $user = Auth::user();
        if($user->role === 'partner'){
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Leaderboard');
    }
    function scan(){
        $user = Auth::user();
        if($user->role === 'partner'){
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Scan');
    }
    function wisata(){
        $user = Auth::user();
        if($user->role === 'partner'){
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Wisata');
    }
    function misi(){
        $user = Auth::user();
        if($user->role === 'partner'){
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Misi');
    }
    function detailmisi(){
        $user = Auth::user();
        if($user->role === 'partner'){
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/DetailMisi');
    }
    function hadiah(){
        $user = Auth::user();
        if($user->role === 'partner'){
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Hadiah');
    }
    function detailhadiah(){
        $user = Auth::user();
        if($user->role === 'partner'){
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/DetailHadiah');
    }
    function profile(){
        $user = Auth::user();
        if($user->role === 'partner'){
            return redirect()->route('dashboard.ekraf');
        }

        return Inertia::render('DashboardWisatawan/Profile');
    }
}
