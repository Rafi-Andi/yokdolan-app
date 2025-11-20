<?php

use App\Http\Controllers\ChannelController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardTouristController;
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

Route::get('home/user', function () {
    return Inertia::render('Home/User');
});

Route::prefix('/')->middleware(['auth'])->group(function () {
    Route::post('/misi/validasi', [DashboardTouristController
    ::class, 'validateScan'])
        ->name('misi.validate');
    Route::get('dashboard', [DashboardTouristController::class, 'index'])->name('dashboard');
    Route::get('dashboard/leaderboard', [DashboardTouristController::class, 'leaderboard'])->name('dashboard.wisatawan.leaderboard');
    Route::get('dashboard/scan', [DashboardTouristController::class, 'scan'])->name('dashboard.wisatawan.scan');
    Route::get('dashboard/wisata', [DashboardTouristController::class, 'wisata'])->name('dashboard.wisatawan.wisata');
    Route::get('dashboard/wisata/{id}', [DashboardTouristController::class, 'misi'])->name('dashboard.wisatawan.misi');
    Route::get('dashboard/misi/{id}', [DashboardTouristController::class, 'detailmisi'])->name('dashboard.wisatawan.detailmisi');
    Route::get('dashboard/hadiah', [DashboardTouristController::class, 'hadiah'])->name('dashboard.wisatawan.hadiah');
    Route::get('dashboard/hadiah/{id}', [DashboardTouristController::class, 'detailhadiah'])->name('dashboard.wisatawan.detailhadiah');
    Route::post('dashboard/hadiah/{id}', [DashboardTouristController::class, 'rewardReedem'])->name('dashboard.wisatawan.detailhadiah');
    Route::get('dashboard/profile', [DashboardTouristController::class, 'profile'])->name('dashboard.wisatawan.profile');


    Route::get('/register/ekraf', [RegisterEkrafController::class, 'index'])->name('register.ekraf');
    Route::post('/register/ekraf', [RegisterEkrafController::class, 'store']);

    Route::get('/dashboard/ekraf', [EkrafPartnerController::class, 'index'])->name('dashboard.ekraf');

    Route::get('/dashboard/ekraf/reward', [EkrafPartnerController::class, 'getAllRewards'])->name('dashboard.ekraf.reward');
    Route::get('/dashboard/ekraf/reward/{id}', [EkrafPartnerController::class, 'getDetailRewards'])->name('dashboard.ekraf.detailreward');
    Route::get('/dashboard/ekraf/add-reward', [EkrafPartnerController::class, 'createReward'])->name('dashboard.ekraf.reward.add');
    Route::post('/dashboard/ekraf/store-reward', [EkrafPartnerController::class, 'storeReward'])->name('dashboard.ekraf.reward.add');
    Route::put('/hadiah/{id}/nonaktif', [EkrafPartnerController::class, 'nonaktifHadiah'])->name('reward.nonaktif');
    Route::put('/hadiah/{id}/aktif', [EkrafPartnerController::class, 'aktifkanHadiah'])->name('reward.aktif');

    Route::post('/dashboard/ekraf/reward/validate-all', [EkrafPartnerController::class, 'validateAllPending'])
        ->name('dashboard.ekraf.validate.all');
    Route::post('/dashboard/ekraf/reward/validate/{id}', [EkrafPartnerController::class, 'validateSingle'])
        ->name('dashboard.ekraf.validate.single');
    Route::post('/dashboard/ekraf/reward/reject/{id}', [EkrafPartnerController::class, 'rejectSingle'])
        ->name('dashboard.ekraf.reject.single');

    Route::get('/dashboard/ekraf/mission', [EkrafPartnerController::class, 'getAllMissions'])->name('dashboard.ekraf.mission');
    Route::get('/dashboard/ekraf/mission/{id}', [EkrafPartnerController::class, 'getDetailMission'])->name('dashboard.ekraf.mission.detail');
    Route::put('/missions/{id}/nonaktif', [EkrafPartnerController::class, 'nonaktifMisi'])->name('missions.nonaktif');
    Route::put('/missions/{id}/aktif', [EkrafPartnerController::class, 'aktifkanMisi'])->name('missions.aktif');
    Route::put('/missions/{id}/aktif', [EkrafPartnerController::class, 'aktifkanMisi'])->name('missions.aktif');
    Route::get('/dashboard/ekraf/add-mission', [EkrafPartnerController::class, 'createMission'])->name('dashboard.ekraf.mission.add');
    Route::post('/dashboard/ekraf/store-mission', [EkrafPartnerController::class, 'storeMission']);
    Route::get('/dashboard/ekraf/validation', [EkrafPartnerController::class, 'getValidation'])->name('dashboard.ekraf.validation');

    Route::get('/register/channel', [RegisterWisataController::class, 'index'])->name('register.channel');
    Route::post('/register/channel', [RegisterWisataController::class, 'store']);

    Route::get('/dashboard/channel', [ChannelController::class, 'index'])->name('dashboard.channel');
    Route::get('/dashboard/channel/ekraf/{id}', [ChannelController::class, 'showEkraf'])->name('dashboard.channel.detail');
    Route::get('/dashboard/channel/ekraf/verify/{id}', [ChannelController::class, 'isVerified'])->name('dashboard.channel.verify');

    Route::get('/dashboard/admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/dashboard/admin/wisata/{id}', [DashboardAdminController::class, 'showChannel'])->name('dashboard.admin.wisata.detail');
    Route::get('/dashboard/admin/wisata/verify/{id}', [DashboardAdminController::class, 'verifyChannel'])->name('dashboard.admin.wisata.verify');
    Route::get('/dashboard/admin/wisata/deactivate/{id}', [DashboardAdminController::class, 'deactivateChannel'])->name('dashboard.admin.wisata.deactivate');
    Route::get('/dashboard/admin/wisata/activate/{id}', [DashboardAdminController::class, 'activateChannel'])->name('dashboard.admin.wisata.activate');
});
require __DIR__ . '/settings.php';
