<?php

use App\Http\Controllers\CarDetailController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/search-car-details', [CarDetailController::class, 'searchDetails'])->name('search-car-details');

Route::post('/store-claim', [CarDetailController::class, 'storeClaim'])->name('store-claim');

route::get('/thank-you', [CarDetailController::class, 'thankYou'])->name('thank-you');
