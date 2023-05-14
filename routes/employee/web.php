<?php

use App\Http\Controllers\Employee\Dashboard\EditProfileController;
use App\Http\Controllers\Employee\Dashboard\ShowDashboardController;
use App\Http\Controllers\Employee\Dashboard\UpdateProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['employee.auth', 'employee.active'])
    ->group(function () {
        Route::get('/', ShowDashboardController::class)->name('dashboard');
        Route::get('/edit', EditProfileController::class)->name('profile.edit');
        Route::post('/edit', UpdateProfileController::class)->name('profile.update');
    });

require __DIR__ . '/auth.php';
