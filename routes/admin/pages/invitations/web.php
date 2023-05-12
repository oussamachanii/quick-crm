<?php

use App\Http\Controllers\Admin\Invitation\DeleteInvitationController;
use App\Http\Controllers\Admin\Invitation\ListInvitationsController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.auth')
    ->name('invitation.')
    ->prefix('/invitation')
    ->group(function () {
        Route::get('/', ListInvitationsController::class)->name('index');
        Route::delete('/{id}', DeleteInvitationController::class)->name('delete');
    });
