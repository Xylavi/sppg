<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\SchoolController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\AdminComplaintController;
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
        return redirect()->route('backend.pengaduan.dashboard');
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

        Route::get('/menus/create', [GiziController::class, 'create'])
            ->name('gizi.menus.create');

        Route::post('/menus', [GiziController::class, 'store'])
            ->name('gizi.menus.store');

        Route::get('/menus/{menu}/edit', [GiziController::class, 'edit'])
            ->name('gizi.menus.edit');

        Route::put('/menus/{menu}', [GiziController::class, 'update'])
            ->name('gizi.menus.update');

        Route::delete('/menus/{menu}', [GiziController::class, 'destroy'])
            ->name('gizi.menus.destroy');

        Route::get('/menus/history', [GiziController::class, 'history'])
            ->name('gizi.menus.history');

        Route::get('/menus/{menu}', [GiziController::class, 'show'])
            ->name('gizi.menus.show');

        Route::get('/porsi-recap', [GiziController::class, 'porsiRecap'])
            ->name('gizi.porsi-recap');
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

        Route::get('/schools', [SchoolController::class, 'index'])
            ->name('admin.schools.index');

        Route::get('/schools/create', [SchoolController::class, 'create'])
            ->name('admin.schools.create');

        Route::post('/schools', [SchoolController::class, 'store'])
            ->name('admin.schools.store');

        Route::get('/schools/{school}/edit', [SchoolController::class, 'edit'])
            ->name('admin.schools.edit');

        Route::put('/schools/{school}', [SchoolController::class, 'update'])
            ->name('admin.schools.update');

        Route::delete('/schools/{school}', [SchoolController::class, 'destroy'])
            ->name('admin.schools.destroy');

        Route::get('/menus', [MenuController::class, 'index'])
            ->name('admin.menus.index');

        Route::get('/menus/history', [MenuController::class, 'history'])
            ->name('admin.menus.history');

        Route::get('/menus/{menu}', [MenuController::class, 'show'])
            ->name('admin.menus.show');

        Route::get('/complaints', [AdminComplaintController::class, 'index'])
            ->name('admin.complaints.index');

        Route::get('/complaints/statistics', [AdminComplaintController::class, 'statistics'])
            ->name('admin.complaints.statistics');

        Route::get('/complaints/{complaint}', [AdminComplaintController::class, 'show'])
            ->name('admin.complaints.show');
    });

Route::middleware(['auth', 'role:petugas_pengaduan'])
    ->prefix('backend/pengaduan')
    ->group(function () {
        Route::get('/', function () {
            return redirect()->route('backend.pengaduan.dashboard');
        });

        Route::get('/dashboard', [PengaduanController::class, 'dashboard'])
            ->name('backend.pengaduan.dashboard');

        Route::get('/list', [PengaduanController::class, 'index'])
            ->name('backend.pengaduan.index');

        Route::get('/{complaint}', [PengaduanController::class, 'show'])
            ->name('backend.pengaduan.show');

        Route::put('/{complaint}', [PengaduanController::class, 'update'])
            ->name('backend.pengaduan.update');
    });
