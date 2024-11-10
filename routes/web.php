<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::resource('users', UserController::class);
    // routes/web.php
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


    // Rute Dashboard
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Rute untuk halaman Rawat Inap
    Route::get('/rawat-inap', function () {
        return Inertia::render('RawatInap');
    })->name('rawat-inap');

    // Rute untuk halaman Rawat Jalan
    Route::get('/rawat-jalan', function () {
        return Inertia::render('RawatJalan');
    })->name('rawat-jalan');

    // Rute untuk halaman IGD
    Route::get('/igd', function () {
        return Inertia::render('IGD');
    })->name('igd');

    // Rute untuk halaman Data Dokter
    Route::get('/dokter', function () {
        return Inertia::render('Dokter');
    })->name('dokter');

    // Rute untuk halaman Data Kasir
    Route::get('/kasir', function () {
        return Inertia::render('Kasir');
    })->name('kasir');

});
