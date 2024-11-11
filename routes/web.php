<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DokterController;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InpatientController;


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


Route::resource('inpatients', InpatientController::class);
    // routes/web.php
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

Route::resource('dokters', DokterController::class);

Route::get('/dashboard', function () {
    // Mengambil role pengguna yang sedang login
    $userRole = Auth::user()->getRoleNames()->first(); // Pastikan Anda menggunakan Spatie Laravel Permission atau metode yang sesuai

    // Kirim data ke komponen Vue
    return Inertia::render('Dashboard', [
        'userRole' => $userRole,  // Data role pengguna
    ]);
})->name('dashboard');


Route::get('/dashboard-user', function () {
    // Mengambil role pengguna yang sedang login
    $userRole = Auth::user()->getRoleNames()->first(); // Pastikan Anda menggunakan Spatie Laravel Permission atau metode yang sesuai

    // Kirim data ke komponen Vue
    return Inertia::render('DashboardUser', [
        'userRole' => $userRole,  // Data role pengguna
    ]);
})->name('dashboard-user');





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

Route::middleware(['auth'])->group(function () {
    Route::get('patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('patients', [PatientController::class, 'store'])->name('patients.store');
    Route::get('patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
    Route::put('patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::get('patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
    Route::get('patients', [PatientController::class, 'index'])->name('patients.index');
});








