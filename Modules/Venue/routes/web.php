<?php

use Illuminate\Support\Facades\Route;
use Modules\Venue\Http\Controllers\VenueController;
use Modules\Venue\Http\Controllers\VenueTypeController;
use Modules\Venue\Http\Controllers\VenueSubTypeController;
use Modules\Venue\Http\Controllers\VenueAmenitiesController;
use Modules\Venue\Http\Controllers\VenueDataFieldController;

/*VenueAmenitiesController
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

     Route::any('/venue', [VenueController::class,'index'])->name('venue');
     Route::any('/venue/create', [VenueController::class,'create'])->name('venue/create');
     Route::any('/venue/show', [VenueController::class,'show'])->name('venue/show');


     
    Route::any('/venuetype', [VenueTypeController::class,'index'])->name('admin/venuetype');
    Route::any('/venuetype/create', [VenueTypeController::class,'create'])->name('venuetype/create');
    Route::any('/venuetype/{id}/edit', [VenueTypeController::class,'edit']);
    Route::put('/venuetype/update', [VenueTypeController::class,'update'])->name('venuetype.update');
    Route::post('/venuetype/store', [VenueTypeController::class,'store'])->name('venuetype.venuetype_add');
    Route::any('/venuetype/show', [VenueTypeController::class,'show'])->name('venuetype/show');
    Route::any('/venuetype/{id}/destroy', [VenueTypeController::class,'destroy']);
    Route::any('/venuetype/{id}/updatestatus', [VenueTypeController::class,'updatestatus']);


    Route::any('/venuesubtype', [VenueSubTypeController::class,'index'])->name('venue/venuesubtype');
    Route::any('/venuesubtype/create', [VenueSubTypeController::class,'create'])->name('venuesubtype/create');
    Route::any('/venuesubtype/{id}/edit', [VenueSubTypeController::class,'edit']);
    Route::put('/venuesubtype/update', [VenueSubTypeController::class,'update'])->name('venuesubtype.update');
    Route::post('/venuesubtype/store', [VenueSubTypeController::class,'store'])->name('venuesubtype.venuetype_add');
    Route::any('/venuesubtype/show', [VenueSubTypeController::class,'show'])->name('venuesubtype/show');
    Route::any('/venuesubtype/{id}/destroy', [VenueSubTypeController::class,'destroy']);
    Route::any('/venuesubtype/{id}/updatestatus', [VenueSubTypeController::class,'updatestatus']);

/* Amenities */

    Route::any('/venueamenities', [VenueAmenitiesController::class,'index'])->name('venue/venueamenities');
    Route::any('/venueamenities/create', [VenueAmenitiesController::class,'create'])->name('venueamenities/create');
    Route::any('/venueamenities/{id}/edit', [VenueAmenitiesController::class,'edit']);
    Route::put('/venueamenities/update', [VenueAmenitiesController::class,'update'])->name('venueamenities.update');
    Route::post('/venueamenities/store', [VenueAmenitiesController::class,'store'])->name('venueamenities.amenities_add');
    Route::any('/venueamenities/show', [VenueAmenitiesController::class,'show'])->name('venueamenities/show');
    Route::any('/venueamenities/{id}/destroy', [VenueAmenitiesController::class,'destroy']);
    Route::any('/venueamenities/{id}/updatestatus', [VenueAmenitiesController::class,'updatestatus']);


    Route::any('/venuesettings', [VenueController::class,'venuesettings'])->name('venuesettings');

    Route::any('/venuesettings/datafield', [VenueDataFieldController::class,'show'])->name('venuesettings/datafield');

   Route::any('/venuesettings/datafield/create', [VenueDataFieldController::class,'create'])->name('venuesettings/datafield/create');

   Route::any('/venuesettings/datafield/add', [VenueDataFieldController::class,'store'])->name('venuesettings.datafield_add');

   Route::any('/venuesettings/datafield/{id}/destroy', [VenueDataFieldController::class,'destroy']);
    Route::any('/venuesettings/datafield/{id}/updatestatus', [VenueDataFieldController::class,'updatestatus']);

    Route::any('/venuesettings/datafield/{id}/edit', [VenueDataFieldController::class,'edit']);
    Route::put('/venuesettings/datafield/update', [VenueDataFieldController::class,'update'])->name('datafield.update');

});

