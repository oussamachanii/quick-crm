<?php

use App\Http\Controllers\Admin\CreateAdminController;
use App\Http\Controllers\Admin\Dashboard\ShowDashboardController;
use App\Http\Controllers\Admin\ListAdminsController;
use App\Http\Controllers\Admin\StoreAdminController;
use Illuminate\Support\Facades\Route;


Route::middleware('admin.auth')
    ->group(function () {
        Route::get('/', ShowDashboardController::class)->name('dashboard');
        Route::get('/list', ListAdminsController::class)->name('index');
        Route::get('/create', CreateAdminController::class)->name('create');
        Route::post('/create', StoreAdminController::class)->name('store');

        require __DIR__ . '/pages/index.php';
    });

require __DIR__ . '/auth.php';
