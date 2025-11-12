<?php

use App\Http\Controllers\EkrafPartnerController;
use Inertia\Inertia;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterEkrafController;
use App\Http\Controllers\RegisterWisataController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canRegister' => Features::enabled(Features::registration()),
    ]);
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('home/user', function () {
    return Inertia::render('Home/User');
});

Route::prefix('/')->middleware(['auth'])->group(function () {
    Route::get('/register/ekraf', [RegisterEkrafController::class, 'index'])->name('register.ekraf');


    Route::post('/register/ekraf', [RegisterEkrafController::class, 'store']);

    Route::get('/register/wisata', function () {
        return Inertia::render('auth/WisataRegister');
    })->name('register.wisata');

    Route::post('/register/wisata', [RegisterWisataController::class, 'store']);

    Route::get('/dashboard/ekraf', [EkrafPartnerController::class, 'index'])->name('dashboard.ekraf');

    Route::get('/dashboard/ekraf/reward', [EkrafPartnerController::class, 'getAllRewards'])->name('dashboard.ekraf.reward');
    Route::get('/dashboard/ekraf/mission', [EkrafPartnerController::class, 'getAllMissions'])->name('dashboard.ekraf.mission');
});
require __DIR__ . '/settings.php';
