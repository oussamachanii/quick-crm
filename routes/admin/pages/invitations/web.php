<?php

use App\Http\Controllers\Admin\Invitation\ListInvitationsController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.auth')
    ->name('invitation.')
    ->prefix('/invitation')
    ->group(function () {
        Route::get('/', ListInvitationsController::class)->name('index');
    });
