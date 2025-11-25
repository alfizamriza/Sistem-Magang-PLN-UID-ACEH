

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AdminAturPosisiController;
use App\Http\Controllers\AdminDivisiController;
Route::put('/dashboard/atur-posisi/{id}', [AdminAturPosisiController::class, 'update'])->name('admin.atur-posisi.update');
Route::put('/dashboard/divisi/{id}/edit', [AdminDivisiController::class, 'update'])->name('admin.divisi.update');
Route::delete('/dashboard/divisi/{id}/delete', [AdminDivisiController::class, 'destroy'])->name('admin.divisi.destroy');

Route::get('/', [LandingPageController::class, 'index']);  // Route untuk landing page
Route::post('/daftar', [LandingPageController::class, 'store']);

// Route halaman sukses
Route::get('/success/{id}', [LandingPageController::class, 'success'])->name('success');

// Route cek status peserta
Route::get('/cek-status', [LandingPageController::class, 'cekStatus']);

// Route login admin
use App\Http\Controllers\AdminAuthController;
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AdminAuthController::class, 'login']);
Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

// Route logout admin
Route::post('/logout', function () {
    session()->flush();
    session()->regenerate();
    return redirect('/');
});

// Dashboard menu routes (protected by admin session)
use App\Http\Controllers\AdminParticipantController;

Route::middleware(\App\Http\Middleware\AdminAuthMiddleware::class)->group(function () {
    // Peserta baru (pending) and detail
    Route::get('/dashboard/peserta-baru', [AdminParticipantController::class, 'pending'])->name('admin.peserta-baru');
    Route::get('/dashboard/peserta-baru/{id}', [AdminParticipantController::class, 'detail'])->name('admin.peserta-detail');

    // Actions: accept/reject/review
    Route::post('/dashboard/peserta-baru/{id}/accept', [AdminParticipantController::class, 'accept'])->name('admin.peserta-accept');
    Route::post('/dashboard/peserta-baru/{id}/reject', [AdminParticipantController::class, 'reject'])->name('admin.peserta-reject');
    Route::post('/dashboard/peserta-baru/{id}/review', [AdminParticipantController::class, 'review'])->name('admin.peserta-review');

    // Download CV
    Route::get('/download/cv/{filename}', [AdminParticipantController::class, 'downloadCv'])->name('admin.download-cv');

    // Semua peserta, export, update, delete
    Route::get('/dashboard/semua-peserta', [AdminParticipantController::class, 'semuaPeserta'])->name('admin.semua-peserta');
    Route::get('/dashboard/semua-peserta/export', [AdminParticipantController::class, 'export'])->name('admin.peserta-export');
    Route::put('/dashboard/semua-peserta/{id}', [AdminParticipantController::class, 'update'])->name('admin.peserta-update');
    Route::delete('/dashboard/semua-peserta/{id}', [AdminParticipantController::class, 'destroy'])->name('admin.peserta-delete');

    // Divisi routes
    Route::get('/dashboard/divisi', [AdminDivisiController::class, 'index'])->name('admin.divisi');
    Route::post('/dashboard/divisi', [AdminDivisiController::class, 'store'])->name('admin.divisi.store');
    Route::put('/dashboard/divisi/{id}/edit', [AdminDivisiController::class, 'update'])->name('admin.divisi.update');
    Route::delete('/dashboard/divisi/{id}/delete', [AdminDivisiController::class, 'destroy'])->name('admin.divisi.destroy');

    // Atur posisi
    Route::get('/dashboard/atur-posisi', [AdminAturPosisiController::class, 'index'])->name('admin.atur-posisi');
    Route::put('/dashboard/atur-posisi/{id}', [AdminAturPosisiController::class, 'update'])->name('admin.atur-posisi.update');

    // Admin peserta index alias
    Route::get('/dashboard/peserta-baru', [AdminParticipantController::class, 'index'])->name('admin.peserta-index');
});