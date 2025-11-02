<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MatkulControllers;
use App\Http\Controllers\ProgressController;

// Public routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'createLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'storeLogin']);

    Route::get('/register', [AuthController::class, 'createRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'storeRegister']);
});

// Protected routes (only for logged-in users)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Matkul routes
    Route::get('/matkuls', [MatkulControllers::class, 'index'])->name('matkuls.index');
    Route::post('/matkuls', [MatkulControllers::class, 'store'])->name('matkuls.store');
    Route::get('/matkuls/{id}', [MatkulControllers::class, 'show'])->name('matkuls.show');

    // Progress routes
    Route::get('/progresses', [ProgressController::class, 'index'])->name('progresses.index');
    Route::post('/progresses', [ProgressController::class, 'store'])->name('progresses.store');
    Route::get('/progresses/matkul/{matkul_id}', [ProgressController::class, 'byMatkul'])->name('progresses.byMatkul');
    Route::get('/progresses/create', [ProgressController::class, 'create'])->name('progresses.create');
    Route::get('/progresses/{id}/edit', [ProgressController::class, 'edit'])->name('progresses.edit');
    Route::put('/progresses/{id}', [ProgressController::class, 'update'])->name('progresses.update');
    Route::delete('/progresses/{id}', [ProgressController::class, 'destroy'])->name('progresses.destroy');
});

//  Default route: redirect to login if not authenticated, otherwise to matkul list
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('matkuls.index');
    }
    return redirect()->route('login');
});
