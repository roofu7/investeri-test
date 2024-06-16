<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyFormController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', [PageController::class, 'getPages'])->name('home');
Route::get('profile', [UserAccountController::class, '__invoke'])->middleware('auth:web')->name('userinfo');
Route::get('profile/company', [CompanyController::class, '__invoke'])->middleware('auth:web')->name('companyinfo');
Route::get('profile/company/create', [CompanyFormController::class, '__invoke'])->middleware('auth:web')->name('create');
Route::post('/profile/company', [CompanyFormController::class, 'store'])->middleware('auth:web')->name('store');
Route::get('/profile/company-profile-create', [CompanyProfileController::class, '__invoke'])->middleware('auth:web')->name('companyprofile');
Route::post('/profile/company-profile', [CompanyProfileController::class, 'store'])->middleware('auth:web')->name('companyprofilestore');
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:web')->name('logout');

