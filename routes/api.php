<?php

use App\Http\Controllers\CarDetailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
// Route::post('/search-car-details', [CarDetailController::class, 'searchDetails'])->name('search-car-details');