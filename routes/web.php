<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\UserController;

/* --- Public --- */

Route::get('/', function () {
    return view('welcome');
});

/* --- Auth --- */

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/* --- Backend Redirect --- */

Route::get('/backend', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect('/backend/admin');
    }

    if ($user->role === 'petugas_gizi') {
        return redirect('/backend/gizi');
    }

    if ($user->role === 'petugas_pengaduan') {
        return redirect('/backend/pengaduan');
    }

    abort(403);
})->middleware('auth');

/* --- Backend Views --- */

Route::middleware('auth')->group(function () {

    Route::get('/backend/admin', function () {
        return view('backend.admin');
    })->middleware('role:admin');

    Route::get('/backend/gizi', function () {
        return view('backend.gizi');
    })->middleware('role:petugas_gizi');

    Route::get('/backend/pengaduan', function () {
        return view('backend.pengaduan');
    })->middleware('role:petugas_pengaduan');
});

/* --- Admin - CRUD --- */

Route::middleware(['auth', 'role:admin'])
    ->prefix('backend/admin')
    ->group(function () {

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
