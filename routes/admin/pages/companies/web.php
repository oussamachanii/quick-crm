<?php

use App\Http\Controllers\Admin\Company\CreateCompanyController;
use App\Http\Controllers\Admin\Company\DeleteCompanyController;
use App\Http\Controllers\Admin\Company\EditCompanyController;
use App\Http\Controllers\Admin\Company\ListCompaniesController;
use App\Http\Controllers\Admin\Company\StoreCompanyController;
use App\Http\Controllers\Admin\Company\UpdateCompanyController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin.auth')
    ->name('company.')
    ->prefix('/company')
    ->group(function () {
        Route::get('/', ListCompaniesController::class)->name('index');
        Route::get('/create', CreateCompanyController::class)->name('create');
        Route::post('/', StoreCompanyController::class)->name('store');
        Route::delete('/{id}', DeleteCompanyController::class)->name('delete');
        Route::get('/{id}', EditCompanyController::class)->name('edit');
        Route::post('/{id}', UpdateCompanyController::class)->name('update');
    });
