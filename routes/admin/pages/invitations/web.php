<?php

use App\Http\Controllers\Admin\Invitation\CreateInvitationController;
use App\Http\Controllers\Admin\Invitation\DeleteInvitationController;
use App\Http\Controllers\Admin\Invitation\ListInvitationsController;
use App\Http\Controllers\Admin\Invitation\StoreInvitationController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.auth')
    ->name('invitation.')
    ->prefix('/invitation')
    ->group(function () {
        Route::get('/', ListInvitationsController::class)->name('index');
        Route::get('/create', CreateInvitationController::class)->name('create');
        Route::post('/create', StoreInvitationController::class)->name('store');
        Route::delete('/{id}', DeleteInvitationController::class)->name('delete');
    });
