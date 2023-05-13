<?php

use App\Http\Controllers\Employee\Auth\LogoutController;
use App\Http\Controllers\Employee\Auth\ShowLoginController;
use App\Http\Controllers\Employee\Auth\StoreLoginController;
use Illuminate\Support\Facades\Route;

Route::name('auth.')
    ->group(function () {
        Route::middleware('employee.guest')
            ->group(function () {
                Route::get('/login', ShowLoginController::class)->name('login.show');
                Route::post('/login', StoreLoginController::class)->name('login.store');
            });

        Route::middleware('employee.auth')
            ->group(function () {
                Route::post('/logout', LogoutController::class)->name('logout');
            });
    });
