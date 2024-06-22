<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\profiles\companies\CompanyActualLocationController;
use App\Http\Controllers\profiles\companies\CompanyContactController;
use App\Http\Controllers\profiles\companies\CompanyController;
use App\Http\Controllers\profiles\companies\CompanyFormController;
use App\Http\Controllers\profiles\companies\CompanyProfileController;
use App\Http\Controllers\profiles\companies\MultiFormController;
use App\Http\Controllers\UserAccountController;
use App\Models\profiles\companies\CompanyActualLocation;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', [PageController::class, 'getPages'])->name('home');

Route::get('personal-account/{user}', [UserAccountController::class, 'index'])->middleware('auth:web')->name('userinfo');
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:web')->name('logout');


//Маршруты компаний
//Route::middleware('auth:web')
//    ->prefix('personal-account/{user}')
//    ->name('company.')
//    ->controller(CompanyController::class)
//    ->group(function () {
//        Route::get('company', 'index')->name('index');
//        Route::get('company/create', 'create')->name('create');
//        Route::post('company', 'store')->name('store');
//        Route::get('company/update', 'edit')->name('edit');
//        Route::delete('company/{id}', 'delete')->name('delete');
//    });

Route::middleware('auth:web')
    ->prefix('personal-account/{user}')
    ->name('company.')
    ->namespace('App\Http\Controllers\profiles\companies')
    ->controller(CompanyController::class)
    ->group(function () {
        Route::get('companies', 'index')->name('index');
//        Route::get('companies/{company}', 'show')->name('show');
        Route::get('companies/create', 'create')->name('create');
        Route::post('companies', 'store')->name('store');
//        Route::put('companies/{company}', 'update')->name('update');
        Route::delete('companies/{id}', 'delete')->name('delete');
    })
    ->controller(MultiFormController::class)
    ->group(function () {
        Route::get('company-profile/{company}', 'create')->name('profile.create');
    })
    ->controller(CompanyContactController::class)
    ->group(function () {
        Route::post('company-profile/contact', 'store')->name('contact.store');
        Route::put('company-profile/contact/{company}', 'update')->name('contact.update');
    })
    ->controller(CompanyActualLocationController::class)
    ->group(function () {
        Route::post('company-profile/actual-address', 'store')->name('actual.address.store');
        Route::put('company-profile/actual-address/{company}', 'update')->name('actual.address.update');
    })
;


//Route::get('company-profile/{company}', [MultiFormController::class, 'create'])->middleware('auth:web')->name('company.profile');
//Route::put('t/{id}', [CompanyController::class, 'update'])->middleware('auth:web')->name('samupdate');
//
//Route::put('r/{id}', [CompanyContactController::class, 'update'])
//    ->middleware('auth:web')
//    ->name('company.contact.update');
//Route::post('/', [CompanyContactController::class, 'store'])
//    ->middleware('auth:web')
//    ->name('company.contact.store');

