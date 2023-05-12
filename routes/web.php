<?php

use App\Http\Controllers\Admin\Invitation\ConnectInvitationController;
use App\Http\Controllers\Admin\Invitation\SubmitInvitationController;
use App\Http\Controllers\ProfileController;
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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::name('admin.')
    ->prefix('admin/')
    ->group(function () {
        require __DIR__ . '/admin/web.php';
    });

Route::get('/invitation/connect/{token}', ConnectInvitationController::class)->name('invitation.connect');
Route::post('/invitation/connect', SubmitInvitationController::class)->name('invitation.submit');
