<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardAdminController extends Controller
{
    public function index(){
        $user = Auth::user();

        if($user->role !== 'admin'){
            abort(403);
        }

        $channels = Channel::all();
        return Inertia::render('DashboardAdmin/Index', [
            'channels' => $channels
        ]);
    }

    public function showChannel($id){
        $user = Auth::user();

        if($user->role !== 'admin'){
            abort(403);
        }

    $channel = Channel::with('owner')->findOrFail($id);
    $email = $channel->owner->email;
        return Inertia::render('DashboardAdmin/ShowChannel', [
            'channel' => $channel,
            'adminEmail' => $email
        ]);
    }
}
