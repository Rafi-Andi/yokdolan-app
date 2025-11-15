<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Pastikan ini di-import

class RegisterWisataController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == "channel_owner") {
            return redirect()
                ->route('dashboard.channel')
                ->with('warning', 'Anda sudah terdaftar sebagai Pemilik wisata.');
        }

        if ($user->channel()->exists()) {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'Pendaftaran Ekraf Anda sudah diproses, menunggu verifikasi Admin.');
        }

        return Inertia::render('auth/ChannelRegister');
    }
    
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:128', Rule::unique('channels', 'name')],
            'location' => ['required', 'string', 'max:50'],
            'phone' => ['required', 'string', 'max:20'], 
            'description' => ['nullable', 'string', 'max:255'], 
            'profile_photo' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        $photoPath = null;

        if ($request->hasFile('profile_photo')) {
            try {
                $photoPath = $request->file('profile_photo')->store('channels/photos', 'public');
            } catch (\Exception $e) {
                return back()->withErrors(['profile_photo' => 'Gagal mengunggah foto. Coba lagi.']);
            }
        }

        // 3. Buat Channel
        Channel::create([
            'owner_user_id' => $user->id,
            'name' => $data['name'],
            'location' => $data['location'],
            'phone' => $data['phone'], 
            'description' => $data['description'], 
            'profile_photo_path' => $photoPath,
            
            'is_verified' => false, 
            
            'is_active' => true,
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran Channel Wisata Berhasil! Mohon tunggu konfirmasi verifikasi dari Admin.');
    }
}