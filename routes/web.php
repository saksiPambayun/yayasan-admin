<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root to admin dashboard
Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

// === REVISI: Login Routes (Tanpa Middleware) ===
Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login.post');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth']) // === REVISI: Proteksi Auth ===
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Santri Registrations
    Route::get('/santri', [AdminController::class, 'santriIndex'])->name('santri.index');
    Route::get('/santri/create', [AdminController::class, 'santriCreate'])->name('santri.create');
    Route::post('/santri', [AdminController::class, 'santriStore'])->name('santri.store');
    Route::get('/santri/{id}', [AdminController::class, 'santriShow'])->name('santri.show');
    Route::get('/santri/{id}/edit', [AdminController::class, 'santriEdit'])->name('santri.edit');
    Route::put('/santri/{id}', [AdminController::class, 'santriUpdate'])->name('santri.update');
    Route::delete('/santri/{id}', [AdminController::class, 'santriDestroy'])->name('santri.destroy');
    Route::post('/santri/{id}/verify', [AdminController::class, 'verifySantri'])->name('santri.verify');

    // Employees/Pegawai
    Route::get('/pegawai', [AdminController::class, 'pegawaiIndex'])->name('pegawai.index');
    Route::get('/pegawai/create', [AdminController::class, 'pegawaiCreate'])->name('pegawai.create');
    Route::post('/pegawai', [AdminController::class, 'pegawaiStore'])->name('pegawai.store');
    Route::get('/pegawai/{id}', [AdminController::class, 'pegawaiShow'])->name('pegawai.show');
    Route::get('/pegawai/{id}/edit', [AdminController::class, 'pegawaiEdit'])->name('pegawai.edit');
    Route::put('/pegawai/{id}', [AdminController::class, 'pegawaiUpdate'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [AdminController::class, 'pegawaiDestroy'])->name('pegawai.destroy');

    // SK (Surat Keputusan)
    Route::get('/sk', [AdminController::class, 'skIndex'])->name('sk.index');
    Route::get('/sk/create', [AdminController::class, 'skCreate'])->name('sk.create');
    Route::post('/sk', [AdminController::class, 'skStore'])->name('sk.store');
    Route::get('/sk/{id}', [AdminController::class, 'skShow'])->name('sk.show');
    Route::get('/sk/{id}/edit', [AdminController::class, 'skEdit'])->name('sk.edit');
    Route::put('/sk/{id}', [AdminController::class, 'skUpdate'])->name('sk.update');
    Route::delete('/sk/{id}', [AdminController::class, 'skDestroy'])->name('sk.destroy');

    // Akta Yayasan
    Route::get('/akta-yayasan', [AdminController::class, 'aktaYayasanIndex'])->name('akta-yayasan.index');
    Route::get('/akta-yayasan/create', [AdminController::class, 'aktaYayasanCreate'])->name('akta-yayasan.create');
    Route::post('/akta-yayasan', [AdminController::class, 'aktaYayasanStore'])->name('akta-yayasan.store');
    Route::get('/akta-yayasan/{id}', [AdminController::class, 'aktaYayasanShow'])->name('akta-yayasan.show');
    Route::get('/akta-yayasan/{id}/edit', [AdminController::class, 'aktaYayasanEdit'])->name('akta-yayasan.edit');
    Route::put('/akta-yayasan/{id}', [AdminController::class, 'aktaYayasanUpdate'])->name('akta-yayasan.update');
    Route::delete('/akta-yayasan/{id}', [AdminController::class, 'aktaYayasanDestroy'])->name('akta-yayasan.destroy');

    // Akta Wakaf
    Route::get('/akta-wakaf', [AdminController::class, 'aktaWakafIndex'])->name('akta-wakaf.index');
    Route::get('/akta-wakaf/create', [AdminController::class, 'aktaWakafCreate'])->name('akta-wakaf.create');
    Route::post('/akta-wakaf', [AdminController::class, 'aktaWakafStore'])->name('akta-wakaf.store');
    Route::get('/akta-wakaf/{id}', [AdminController::class, 'aktaWakafShow'])->name('akta-wakaf.show');
    Route::get('/akta-wakaf/{id}/edit', [AdminController::class, 'aktaWakafEdit'])->name('akta-wakaf.edit');
    Route::put('/akta-wakaf/{id}', [AdminController::class, 'aktaWakafUpdate'])->name('akta-wakaf.update');
    Route::delete('/akta-wakaf/{id}', [AdminController::class, 'aktaWakafDestroy'])->name('akta-wakaf.destroy');

    // Profile & Settings
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/change-password', [AdminController::class, 'changePassword'])->name('profile.change-password');
    Route::post('/profile/change-email', [AdminController::class, 'changeEmail'])->name('profile.change-email');

    // Logout (Di dalam prefix admin agar konsisten)
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
});
