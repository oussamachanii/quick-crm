<?php

use App\Http\Controllers\Admin\Invitation\ConnectInvitationController;
use App\Http\Controllers\Admin\Invitation\SubmitInvitationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::name('admin.')
    ->prefix('admin/')
    ->group(function () {
        require __DIR__ . '/admin/web.php';
    });

Route::name('employee.')
    ->prefix('employee/')
    ->group(function () {
        require __DIR__ . '/employee/web.php';
    });

Route::get('/invitation/connect/{token}', ConnectInvitationController::class)->name('invitation.connect');
Route::post('/invitation/connect', SubmitInvitationController::class)->name('invitation.submit');
