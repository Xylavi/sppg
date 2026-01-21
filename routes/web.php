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
