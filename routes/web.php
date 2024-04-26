<?php

use App\Http\Controllers\CarDetailController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Pcp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/search-car-details', [CarDetailController::class, 'searchDetails'])->name('search-car-details');

Route::post('/store-claim', [CarDetailController::class, 'storeClaim'])->name('store-claim');

route::get('/thank-you', [CarDetailController::class, 'thankYou'])->name('thank-you');




Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [DashboardController::class, 'setting'])->name('settings');
    Route::post('/settings', [DashboardController::class, 'settingUpdate'])->name('settings.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
