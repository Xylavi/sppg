<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/backend', function(){
    return 'Login berhasil';
})->middleware(['auth', 'cache.headers:no_store']);

Route::middleware(['auth'])->group(function() {
    Route::get('/backend', function() {
        return 'Dashboard';
    });

    Route::get('/backend/admin', function() {
        return view('backend.admin');
    })->middleware('role:admin');

    Route::get('/backend/gizi', function() {
        return 'Gizi';
    })->middleware('role:petugas_gizi');

    Route::get('/backend/pengaduan', function() {
        return "Pengaduan";
    })->middleware('role:petugas_pengaduan');
});
