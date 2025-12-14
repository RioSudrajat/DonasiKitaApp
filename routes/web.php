<?php

use App\Http\Controllers\DonationController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ProfileController; // Tambahan dari Breeze
use Illuminate\Support\Facades\Route;

// --- ROUTE APLIKASI DONASI KITA ---

// Halaman Utama (Landing Page)
Route::get('/', [DonationController::class, 'index'])->name('home');

// Halaman Semua Kampanye
Route::get('/kampanye', [CampaignController::class, 'index'])->name('campaigns.index');

// Halaman Detail Campaign
Route::get('/campaign/{campaign}', [CampaignController::class, 'show'])->name('campaign.show');

// Real-time Campaign Data API
Route::get('/campaign/{campaign}/realtime', [CampaignController::class, 'realTimeData'])->name('campaign.realtime');

// Real-time All Campaigns API for Landing Page
Route::get('/api/campaigns-realtime', [DonationController::class, 'campaignsRealtime'])->name('campaigns.realtime');

// Check payment status untuk admin (real-time) - juga verify ke Midtrans
Route::get('/api/donation/{orderId}/status', [DonationController::class, 'checkPaymentStatus'])->name('donation.check-status');

// Verify & auto-update payment status untuk donation admin panel
Route::post('/api/donation/{orderId}/verify', [DonationController::class, 'verifyAndUpdatePayment'])->middleware('admin')->name('donation.verify-payment');

// Form Donasi Campaign
Route::get('/campaign/{campaign}/donate', [DonationController::class, 'form'])->name('donation.form');

// Proses Simpan Donasi (AJAX)
Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');

// Callback Midtrans
Route::post('/donation/callback', [DonationController::class, 'callback'])->name('donation.callback');

// Halaman Sukses Donasi
Route::get('/donation/success', [DonationController::class, 'success'])->name('donation.success');


// --- ROUTE BAWAAN BREEZE (AUTH) ---

Route::get('/migrate-db', function () {
    \Illuminate\Support\Facades\Artisan::call('migrate:force');
    return 'Migrated!';
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// File ini sekarang pasti sudah ada setelah install breeze
require __DIR__.'/auth.php';

// --- ROUTE ADMIN PANEL ---
require __DIR__.'/admin.php';


