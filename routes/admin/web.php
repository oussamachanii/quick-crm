<?php

use App\Http\Controllers\Admin\Dashboard\ShowDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.auth')
    ->group(function () {
        Route::get('/dashboard', ShowDashboardController::class)->name('dashboard');
    });

require __DIR__ . '/auth.php';
