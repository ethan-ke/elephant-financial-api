<?php

use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\PerformanceController;
use App\Http\Controllers\Backend\StaffController;
use Illuminate\Support\Facades\Route;

Route::resource('staff', StaffController::class);
Route::resource('district', DistrictController::class);
Route::resource('performance', PerformanceController::class);
