<?php

use App\Http\Controllers\AuthentificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('landingPage')->middleware('guest');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login',[AuthentificationController::class, 'login'])->name('login');
    Route::post('/signIn',[AuthentificationController::class, 'signIn'])->name('signIn');
    Route::get('/checkRoles', [AuthentificationController::class, 'checkRoles'])->name('checkRole');
});

Route::group(['middleware' => ['patient', 'auth']], function () {
    // show all middleware
    Route::get('/patient', function () {
        return 'patient only';
    })->name('dashboard');
});

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin', function () {
        return 'admin only';
    })->name('dashboard2');
});
