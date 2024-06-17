<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\profiles\companies\CompanyController;
use App\Http\Controllers\profiles\companies\CompanyFormController;
use App\Http\Controllers\profiles\companies\CompanyProfileController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', [PageController::class, 'getPages'])->name('home');
Route::get('profile', [UserAccountController::class, '__invoke'])->middleware('auth:web')->name('userinfo');
//Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:web')->name('logout');

Route::middleware('auth:web')
    ->prefix('profile')
    ->name('company.')
    ->controller(CompanyController::class)
    ->group(function () {
        Route::get('company', 'index')->name('index');
        Route::get('company/create', 'create')->name('create');
        Route::post('company', 'store')->name('store');
        Route::put('company', 'update')->name('update');
        Route::delete('company', 'delete')->name('delete');
});
