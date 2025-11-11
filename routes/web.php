<?php

use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SkController;
use App\Http\Controllers\SkivController;
use App\Http\Controllers\SkpController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'showLogin']);

Route::middleware('auth')->group(function () {
    // pegawai
    Route::resource('pegawai', PegawaiController::class);
    // riwayat
    Route::resource('riwayat', RiwayatController::class);
    // administrasi
    Route::resource('administrasi', AdministrasiController::class);
    // skp
    Route::resource('skp', SkpController::class);
    // sk
    Route::resource('sk', SkController::class);
    // skiv
    Route::resource('skiv', SkivController::class);
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('show.register');
    Route::get('/login', 'showLogin')->name('show.login');
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
