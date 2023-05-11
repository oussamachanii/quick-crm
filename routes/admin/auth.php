<?php

use App\Http\Controllers\Admin\Auth\ShowLoginController;
use App\Http\Controllers\Admin\Auth\StoreLoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.guest')
    ->name('auth.')
    ->group(function () {
        Route::get('/login', ShowLoginController::class)->name('login.show');
        Route::post('/login', StoreLoginController::class)->name('login.store');
        Route::post('/login', StoreLoginController::class)->name('logout');
    });
