<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\PerhitunganWPController;
use App\Http\Controllers\NilaiAlternatifController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users', UserController::class);
Route::get('/profile', [UserController::class, 'profile'])->name('profile')->middleware('auth');

Route::resource('kriteria', KriteriaController::class);
Route::resource('alternatif', AlternatifController::class);
Route::get('nilai-alternatif', [NilaiAlternatifController::class, 'index'])->name('nilai_alternatif.index');
Route::post('nilai-alternatif/{alternatif}', [NilaiAlternatifController::class, 'storeOrUpdate'])->name('nilai_alternatif.storeOrUpdate');
Route::get('/perhitungan', [PerhitunganWPController::class, 'index'])
    ->name('perhitungan.index');
Route::get('/riwayat', [RiwayatController::class, 'index'])->name('riwayat.index');
Route::get('/riwayat/cetak/{kelas_id}', [RiwayatController::class, 'cetakPDF'])->name('riwayat.cetak');

// Hasil Akhir WP
Route::get('/hasil', [HasilController::class, 'index'])
    ->name('hasil.index');
Route::resource('kelas', KelasController::class);
