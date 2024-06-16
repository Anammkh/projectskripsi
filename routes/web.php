<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\SkilController;
use App\Http\Controllers\LamaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\PelamarController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::get('/', [LandingpageController::class, 'index'])->name('welcome');
Route::get('/semualowongan', [LowonganController::class, 'indexPelamar'])->name('Pelamar.semualowongan');
Route::get('lowongan/detail/{id}', [LowonganController::class, 'showDetail'])->name('lowongan.detail');
Route::get('/mitra/detail/{id}', [MitraController::class, 'detail'])->name('mitra.detail');

Route::resource('lowongan', LowonganController::class);

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::resource('usermanajemen', UserController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('mitra', MitraController::class);
    Route::resource('skil', SkilController::class);
    Route::resource('lamaran', LamaranController::class);
    Route::post('lamarans/{lamaran}/accept', [LamaranController::class, 'accept'])->name('lamarans.accept');
    Route::post('lamarans/{lamaran}/reject', [LamaranController::class, 'reject'])->name('lamarans.reject');
    Route::get('/pelamar/{id}', [PelamarController::class, 'show'])->name('pelamar.show');

    Route::get('pelamar', [PelamarController::class, 'index'])->name('pelamar');
});
Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/halamanpelamar', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/recommendations', [LowonganController::class, 'recommendJobs'])->name('lowongan.rekomendasi');
    Route::post('/lowongan/lamar/{lowongan}', [LamaranController::class, 'lamar'])->name('lowongan.lamar');
    Route::get('/status', [LamaranController::class, 'statusPendaftaran'])->name('lamaran.status');
    Route::get('/complete-profile', [UserController::class, 'showCompleteProfileForm'])->name('complete-profile-form');
    Route::post('/complete-profile/add', [UserController::class, 'completeProfile'])->name('complete-profile');
});
