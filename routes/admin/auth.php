<?php

use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Auth\ShowLoginController;
use App\Http\Controllers\Admin\Auth\StoreLoginController;
use Illuminate\Support\Facades\Route;

Route::name('auth.')
    ->group(function () {
        Route::get('/login', ShowLoginController::class)->name('login.show')->middleware('admin.guest');
        Route::post('/login', StoreLoginController::class)->name('login.store')->middleware('admin.guest');
        Route::post('/logout', LogoutController::class)->name('logout')->middleware('admin.auth');
    });
