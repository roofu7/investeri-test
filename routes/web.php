<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\profiles\companies\CompanyActualLocationController;
use App\Http\Controllers\profiles\companies\CompanyContactController;
use App\Http\Controllers\profiles\companies\CompanyController;
use App\Http\Controllers\profiles\companies\CompanyDetailsController;
use App\Http\Controllers\profiles\companies\MultiFormController;
use App\Http\Controllers\profiles\Individual\IndividualUserAddressController;
use App\Http\Controllers\profiles\Individual\IndividualUserContactController;
use App\Http\Controllers\profiles\Individual\IndividualUserController;
use App\Http\Controllers\profiles\Individual\IndividualUserDetailController;
use App\Http\Controllers\profiles\Individual\IndividualUserInvestProjectController;
use App\Http\Controllers\profiles\Individual\IndividualUserPassportController;
use App\Http\Controllers\profiles\investProjects\InvestProjectController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', [PageController::class, 'getPages'])->name('home');

Route::get('personal-account/{user}', [UserAccountController::class, 'index'])->middleware('auth:web')->name('userinfo');
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:web')->name('logout');

Route::middleware('auth:web')
    ->prefix('personal-account/{user}/companies')
    ->name('company.')
    ->namespace('App\Http\Controllers\profiles\companies')
    ->controller(CompanyController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
//        Route::get('companies/{company}', 'show')->name('show');
        Route::get('create', 'create')->name('create');
        Route::post('/', 'store')->name('store');
        Route::put('update', 'update')->name('update');
        Route::delete('{id}', 'delete')->name('delete');
    })
    ->controller(MultiFormController::class)
    ->group(function () {
        Route::get('company-profile/{company}', 'create')->name('profile.create');
    })
    ->controller(CompanyContactController::class)
    ->group(function () {
        Route::post('contact/store', 'store')->name('contact.store');
        Route::put('contact/update', 'update')->name('contact.update');
    })
    ->controller(CompanyActualLocationController::class)
    ->group(function () {
        Route::post('actual-address/store', 'store')->name('actual.address.store');
        Route::put('actual-address/update', 'update')->name('actual.address.update');
    })
    ->controller(CompanyDetailsController::class)
    ->group(function () {
        Route::get('details/{id}', 'index')->name('details.index');
    })
    ->prefix('personal-account/{user}/invest-projects')
    ->name('invest.projects.')
    ->namespace('App\Http\Controllers\profiles\investProjects')
    ->controller(InvestProjectController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
    })
    ->prefix('personal-account/{user}/individual')
    ->name('individual.')
    ->namespace('App\Http\Controllers\profiles\Individual')
    ->controller(IndividualUserController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
    })
    ->controller(IndividualUserPassportController::class)
    ->group(function () {
        Route::post('passport/store', 'store')->name('passport.store');
        Route::put('passport/update', 'update')->name('passport.update');
    })
    ->controller(IndividualUserAddressController::class)
    ->group(function () {
        Route::post('address/store', 'store')->name('address.store');
        Route::put('address/update', 'update')->name('address.update');
    })
    ->controller(IndividualUserDetailController::class)
    ->group(function () {
        Route::get('details/{id}', 'index')->name('details.index');
    })
    ->controller(IndividualUserContactController::class)
    ->group(function () {
        Route::post('contact/store', 'store')->name('contact.store');
        Route::put('contact/update', 'update')->name('contact.update');
    })
    ->prefix('personal-account/{user}/individual/invest-projects')
    ->name('individual.invest.projects.')
    ->namespace('App\Http\Controllers\profiles\Individual')
    ->controller(IndividualUserInvestProjectController::class)
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::put('update', 'update')->name('update');
    })


;



