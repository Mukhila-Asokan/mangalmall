<?php

use Illuminate\Support\Facades\Route;
use Modules\VenueAdmin\Http\Controllers\VenueAdminController;
use Modules\VenueAdmin\Http\Controllers\VenueBookingController;

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

/*Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('venueadmin', VenueAdminController::class)->names('venueadmin');
    
});*/
Route::prefix('venueadmin')->middleware([VenueAdminMiddleware::class, FlashMessageMiddleware::class])->group(function () { 

  
});

  Route::any('/{id}/get-events',[VenueBookingController::class, 'getEventlist']);
  Route::any('/save-booking',[VenueBookingController::class, 'savebooking']);
  Route::put('/api/update-booking/{id}', [YourController::class, 'updatebooking']);
Route::delete('/api/delete-booking/{id}', [YourController::class, 'deletebooking']);

Route::any('/get-event-details/{id}',[VenueBookingController::class, 'getEventsbyid']);