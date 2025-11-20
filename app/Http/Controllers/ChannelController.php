<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Channel;
use App\Models\EkrafPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'channel_owner') {
            return redirect()->route('dashboard')->with('warning', 'Akses ditolak. Anda bukan Pemilik Channel Wisata.');
        }

        $channel = Channel::with('ekrafPartners')->where('owner_user_id', $user->id)->first();
        $ekrafPartners = $channel ? $channel->ekrafPartners : [];
        return Inertia::render('DashboardChannel/Index', [
            'user' => $user,
            'channel' => $channel,
            'ekrafPartners' => $ekrafPartners
        ]);
    }

    public function showEkraf($id)
    {
        $user = Auth::user();
        if ($user->role !== 'channel_owner') {
            return redirect()->route('dashboard')->with('warning', 'Akses ditolak. Anda bukan Pemilik Channel Wisata.');
        }

        $ekraf = EkrafPartner::findOrFail($id);
        return Inertia::render('DashboardChannel/showEkraf', [
            'ekraf' => $ekraf
        ]);
    }

    public function isVerified($id)
    {
        $user = Auth::user();
        if ($user->role !== 'channel_owner') {
            return redirect()->route('dashboard')->with('warning', 'Akses ditolak. Anda bukan Pemilik Channel Wisata.');
        }

        $ekraf = EkrafPartner::with('user')->findOrFail($id);
        $channel = Channel::where('owner_user_id', $user->id)->first();
        if (!$channel) {
            return redirect()->back()->with('error', 'Anda tidak memiliki channel.');
        }
        if ($ekraf->channel_id !== $channel->id) {
            return redirect()->back()->with('error', 'Anda tidak berhak memverifikasi partner dari channel lain.');
        }
        $ekraf->is_verified = true;
        $ekraf->save();
        $ekraf->user->role = 'partner';
        $ekraf->user->save();
        return redirect()->back();
    }
    
    public function nonActive($id)
    {
        $user = Auth::user();
        if ($user->role !== 'channel_owner') {
            return redirect()->route('dashboard')->with('warning', 'Akses ditolak. Anda bukan Pemilik Channel Wisata.');
        }

        $ekraf = EkrafPartner::with('user')->findOrFail($id);
        $channel = Channel::where('owner_user_id', $user->id)->first();
        if (!$channel) {
            return redirect()->back()->with('error', 'Anda tidak memiliki channel.');
        }
        if ($ekraf->channel_id !== $channel->id) {
            return redirect()->back()->with('error', 'Anda tidak berhak menonaktifkan partner dari channel lain.');
        }
        $ekraf->is_verified = false;
        $ekraf->save();
        return redirect()->back();
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
    public function show(Channel $channel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Channel $channel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Channel $channel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Channel $channel)
    {
        //
    }
}
