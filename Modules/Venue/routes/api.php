<?php

use Illuminate\Support\Facades\Route;
use Modules\Venue\Http\Controllers\VenueController;
use Illuminate\Support\Facades\Log;
use Modules\Venue\Models\indialocation;
use App\Http\Controllers\VenueSearchController;
use Illuminate\Http\Request;
/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware(['auth'])->group(function () {
    Route::apiResource('venue', VenueController::class)->names('venue');
    
});

Route::get('/areas', [VenueSearchController::class, 'searchAreas']);



Route::middleware('auth')->group(function () {

    });


Route::any('/venuereact-search', [VenueSearchController::class, 'searchvenue'])->name('venuereact.search');
