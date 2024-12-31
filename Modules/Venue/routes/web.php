<?php

use Illuminate\Support\Facades\Route;
use Modules\Venue\Http\Controllers\VenueController;
use Modules\Venue\Http\Controllers\VenueTypeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::group([], function () {
    Route::any('venue', VenueController::class)->names('venue');
});

*/


Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::any('/venuetype', [VenueTypeController::class,'index'])->name('admin/venuetype');
    Route::any('/venuetype/create', [VenueTypeController::class,'create'])->name('venuetype/create');
    Route::any('/venuetype/show', [VenueTypeController::class,'show'])->name('venuetype/show');
});

