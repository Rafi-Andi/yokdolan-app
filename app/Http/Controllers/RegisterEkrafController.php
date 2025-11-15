<?php

namespace App\Http\Controllers;

use App\Models\EkrafPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RegisterEkrafController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role == "partner") {
            return redirect()
                ->route('dashboard.ekraf')
                ->with('warning', 'Anda sudah terdaftar sebagai mitra Ekraf.');
        }

        if ($user->ekrafPartner()->exists()) {
            return redirect()
                ->route('dashboard')
                ->with('warning', 'Pendaftaran Ekraf Anda sudah diproses, menunggu verifikasi Admin.');
        }

        return Inertia::render('auth/EkrafRegister');
    }
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'business_name' => ['required', 'string', 'max:128', 'unique:ekraf_partners,business_name'],
            'business_address' => ['required', 'string'],
            'phone' => ['required', 'string', 'max:20'], 
        ]);

        EkrafPartner::create([
            "user_id" => $user->id,
            "business_name" => $data['business_name'],
            "business_address" => $data['business_address'],
            "phone" => $data['phone'],
            "is_verified" => false,
        ]);
        

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran ekraf Berhasil! Mohon tunggu konfirmasi verifikasi dari Admin.');
    }
}
