<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\ManagementFaksinController;
use App\Http\Controllers\PromosiKesehatanController;
use App\Http\Controllers\KriteriaPenyakitMenularController;
use App\Http\Controllers\LaporanRekamanMedisController;
use App\Http\Controllers\TransaksiAdminController;

Route::get('/', [LandingPageController::class, 'index'])->name('landingPage')->middleware('guest');

Route::get('/logout', [AuthentificationController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login',[AuthentificationController::class, 'login'])->name('login');
    Route::post('/signIn',[AuthentificationController::class, 'signIn'])->name('signIn');
    Route::get('/register', [AuthentificationController::class, 'register'])->name('register');
    Route::post('/register', [AuthentificationController::class, 'registerUser'])->name('register.user');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/checkRoles', [AuthentificationController::class, 'checkRoles'])->name('checkRole');
    Route::get('/rekam-medis/{id}', [LaporanRekamanMedisController::class, 'viewRekam'])->name('rekam.medis.show');
});



Route::group(['middleware' => ['patient', 'auth']], function () {
    Route::get('/patient', [DaftarController::class, 'index'])->name('dashboard');
    Route::post('/patient/daftarPelayanan', [DaftarController::class, 'daftarPelayanan'])->name('daftarPelayanan');
    Route::put('/patient/daftarPelayanan/{id}', [DaftarController::class, 'update'])->name('updateTransaksi');
    Route::delete('/patient/daftarPelayanan/{id}', [DaftarController::class, 'destroy'])->name('deleteTransaksi');

    Route::get('/patient/rekam-medis', [DaftarController::class, 'rekamMedis'])->name('rekam.medis');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', [KriteriaPenyakitMenularController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/kriteria', [KriteriaPenyakitMenularController::class, 'store'])->name('admin.kriteria.store');
    Route::put('/admin/kriteria/{id}', [KriteriaPenyakitMenularController::class, 'update'])->name('admin.kriteria.update');
    Route::delete('/admin/kriteria/{id}', [KriteriaPenyakitMenularController::class, 'destroy'])->name('admin.kriteria.destroy');

    Route::get('/admin/promosi', [PromosiKesehatanController::class, 'index'])->name('admin.promosi.index');
    Route::post('/admin/promosi', [PromosiKesehatanController::class, 'store'])->name('admin.promosi.store');
    Route::put('/admin/promosi/{id}', [PromosiKesehatanController::class, 'update'])->name('admin.promosi.update');
    Route::delete('/admin/promosi/{id}', [PromosiKesehatanController::class, 'destroy'])->name('admin.promosi.destroy');

    Route::get('/admin/faksin', [ManagementFaksinController::class, 'index'])->name('admin.faksin.index');
    Route::post('/admin/faksin', [ManagementFaksinController::class, 'store'])->name('admin.faksin.store');
    Route::put('/admin/faksin/{id}', [ManagementFaksinController::class, 'update'])->name('admin.faksin.update');
    Route::delete('/admin/faksin/{id}', [ManagementFaksinController::class, 'destroy'])->name('admin.faksin.destroy');

    Route::get('/admin/transaksi', [TransaksiAdminController::class, 'index'])->name('admin.transaksi.index');
    Route::put('/admin/transaksi/updateStatus/{id}', [TransaksiAdminController::class, 'updateStatus'])->name('admin.transaksi.updateStatus');
    Route::delete('/admin/transaksi/{id}', [TransaksiAdminController::class, 'destroy'])->name('admin.transaksi.destroy');
    Route::post('/admin/transaksi/publishRekamanMedis/{id}', [TransaksiAdminController::class, 'publishRekamanMedis'])->name('admin.transaksi.publishRekamanMedis');

    Route::get('/admin/laporan-rekaman-medis', [LaporanRekamanMedisController::class, 'index'])->name('admin.laporan-rekaman-medis.index');
    Route::get('/admin/laporan-rekaman-medis/print', [LaporanRekamanMedisController::class, 'print'])->name('admin.laporan-rekaman-medis.print');
});
