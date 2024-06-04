<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\UserAccountController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::get('/', [PageController::class, 'getPages'])->name('home');
Route::get('user_info', [UserAccountController::class, '__invoke'])->middleware('auth:web')->name('userinfo');
Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:web')->name('logout');

