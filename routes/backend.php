<?php

use App\Http\Controllers\Backend\AuthorizationsController;
use App\Http\Controllers\Backend\BackendUsersController;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\PerformanceController;
use App\Http\Controllers\Backend\StaffController;
use Illuminate\Support\Facades\Route;

Route::post('authorizations', [AuthorizationsController::class, 'store'])
    ->name('authorizations.store');
// 刷新token
Route::put('authorizations/current', [AuthorizationsController::class, 'update'])
    ->name('authorizations.update');
// 删除token
Route::delete('authorizations/current', [AuthorizationsController::class, 'destroy'])
    ->name('authorizations.destroy');

// Authenticated
Route::middleware('auth:backend')->group(function () {
//    Route::resource('users', BackendUser::class);
    Route::get('user', [BackendUsersController::class, 'me']);


    Route::resource('staff', StaffController::class);
    Route::resource('district', DistrictController::class);
    Route::resource('performance', PerformanceController::class);

});
