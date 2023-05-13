<?php

use App\Http\Controllers\Employee\Dashboard\ShowDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['employee.auth', 'employee.active'])
    ->group(function () {
        Route::get('/', ShowDashboardController::class)->name('dashboard');

        require __DIR__ . '/pages/index.php';
    });

require __DIR__ . '/auth.php';
