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

    public function verifyChannel($id){
        $user = Auth::user();

        if($user->role !== 'admin'){
            abort(403);
        }

        $channel = Channel::with('owner')->findOrFail($id);
        $channel->is_verified = true;
        $channel->is_active = true;
        $channel->owner->role = 'channel_owner';
        $channel->save();

        return redirect()->back()->with('success', 'Channel berhasil diverifikasi dan diaktifkan.');
    }

    public function deactivateChannel($id){
        $user = Auth::user();

        if($user->role !== 'admin'){
            abort(403);
        }

        $channel = Channel::findOrFail($id);
        $channel->is_active = false;
        $channel->save();

        return redirect()->back()->with('success', 'Channel berhasil dinonaktifkan.');
    }
    public function activateChannel($id){
        $user = Auth::user();

        if($user->role !== 'admin'){
            abort(403);
        }

        $channel = Channel::findOrFail($id);
        $channel->is_active = true;
        $channel->save();

        return redirect()->back()->with('success', 'Channel berhasil diaktifkan.');
    }
}
