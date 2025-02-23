<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarePlanController;  // Only import once

// Welcome page route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard route (requires authentication)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// Authentication routes (if using Breeze or Fortify)
require __DIR__.'/auth.php';

// Protect CarePlans routes (only accessible if logged in)
Route::middleware(['auth'])->group(function () {
    Route::resource('careplans', CarePlanController::class);
});

// Optionally, you can use the second middleware with 'auth' and 'load.user.role' as well
Route::middleware(['auth', 'load.user.role'])->group(function () {
    Route::resource('careplans', CarePlanController::class);
});
