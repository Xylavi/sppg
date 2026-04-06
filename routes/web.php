<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\GiziController;
use App\Http\Controllers\Backend\PengaduanController;
use App\Http\Controllers\FrontendController;

/* --- Public --- */

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/menu/{menu}', [FrontendController::class, 'menuDetail'])->name('frontend.menu-detail');
Route::get('/riwayat-menu', [FrontendController::class, 'riwayatMenu'])->name('frontend.riwayat-menu');
Route::get('/tim-sppg', [FrontendController::class, 'tim'])->name('frontend.tim');
Route::get('/pengaduan', [FrontendController::class, 'pengaduan'])->name('frontend.pengaduan');
Route::post('/pengaduan', [FrontendController::class, 'submitPengaduan'])->name('frontend.pengaduan.store');
Route::get('/aduan-publik', [FrontendController::class, 'aduanPublik'])->name('frontend.aduan-publik');
Route::get('/kontak-lokasi', [FrontendController::class, 'kontakLokasi'])->name('frontend.kontak-lokasi');
Route::get('/cek-tiket', [FrontendController::class, 'cekTiket'])->name('frontend.cek-tiket');

/* --- Auth --- */

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/* --- Backend Redirect --- */

Route::get('/backend', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.users.index');
    }

    if ($user->role === 'petugas_gizi') {
        return redirect()->route('gizi.dashboard');
    }

    if ($user->role === 'petugas_pengaduan') {
        return redirect()->route('backend.pengaduan.index');
    }

    abort(403);
})->middleware('auth');

/* --- Backend Views --- */

Route::middleware(['auth', 'role:petugas_gizi'])
    ->prefix('backend/gizi')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('gizi.dashboard');
        });

        Route::get('/dashboard', [GiziController::class, 'dashboard'])
            ->name('gizi.dashboard');
    });

/* --- Admin - CRUD --- */

Route::middleware(['auth', 'role:admin'])
    ->prefix('backend/admin')
    ->group(function () {

        Route::get('/', function () {
            return redirect()->route('admin.users.index');
        });

        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.users.index');

        Route::get('/users/create', [UserController::class, 'create'])
            ->name('admin.users.create');

        Route::post('/users', [UserController::class, 'store'])
            ->name('admin.users.store');

        Route::get('/users/{id}/edit', [UserController::class, 'edit'])
            ->name('admin.users.edit');

        Route::put('/users/{id}', [UserController::class, 'update'])
            ->name('admin.users.update');

        Route::delete('/users/{id}', [UserController::class, 'destroy'])
            ->name('admin.users.destroy');
    });

Route::middleware(['auth', 'role:petugas_pengaduan'])
    ->prefix('backend/pengaduan')
    ->group(function () {
        Route::get('/', [PengaduanController::class, 'index'])
            ->name('backend.pengaduan.index');

        Route::get('/{complaint}', [PengaduanController::class, 'show'])
            ->name('backend.pengaduan.show');

        Route::put('/{complaint}', [PengaduanController::class, 'update'])
            ->name('backend.pengaduan.update');
    });
