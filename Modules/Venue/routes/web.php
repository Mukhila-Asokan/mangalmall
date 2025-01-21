<?php

use Illuminate\Support\Facades\Route;
use Modules\Venue\Http\Controllers\VenueController;
use Modules\Venue\Http\Controllers\VenueTypeController;
use Modules\Venue\Http\Controllers\VenueSubTypeController;
use Modules\Venue\Http\Controllers\VenueAmenitiesController;
use Modules\Venue\Http\Controllers\VenueDataFieldController;
use Modules\Venue\Http\Controllers\ThemeBuilderController;

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
    Route::any('/venue/create/ajaxcitylist', [VenueController::class,'ajaxcitylist'])->name('venue/create/ajaxcitylist');
    Route::any('/venue/create/ajaxcvenuesubtypelist', [VenueController::class,'ajaxcvenuesubtypelist'])->name('venue/create/ajaxcvenuesubtypelist');
    Route::post('/venue/store', [VenueController::class,'store'])->name('venue.venue_add');
    Route::any('/venue/show', [VenueController::class,'index'])->name('venue/index');
    Route::any('/venue/detailview/{id}', [VenueController::class,'detailview'])->name('venue/detailview');
    Route::any('/venue/{id}/edit', [VenueController::class,'edit']);
    Route::any('/venue/{id}/themebuilder', [VenueController::class,'themebuilder'])->name('venue/themelistview');
    Route::any('/venue/themebuilder/{venueid}/{id}/editor', [VenueController::class,'themeeditor'])->name('venue/themelistview/editor');

    Route::any('venue/updatetheme_venue', [VenueController::class,'updatetheme_venue'])->name('venue/updatetheme_venue');

    Route::any('venue/theme/upload_image', [VenueController::class,'upload_image'])->name('venue/theme/upload_image');
    Route::any('venue/theme/load_media_library_img', [VenueController::class,'load_media_library_img'])->name('venue/theme/load_media_library_img');

    Route::any('venue/theme/load_api_img', [VenueController::class,'load_api_img'])->name('venue/theme/load_api_img');
    Route::any('venue/theme/uploadImageUrl', [VenueController::class,'uploadImageUrl'])->name('venue/theme/uploadImageUrl');

     Route::any('venue/theme/saveMyTemplate', [VenueController::class,'saveMyTemplate'])->name('venue/theme/saveMyTemplate');

    Route::any('/venue/venuethemes', [ThemeBuilderController::class,'index'])->name('admin/venuethemes');

    Route::any('/venue/themebuilder', [ThemeBuilderController::class,'index'])->name('admin/themebuilder');

    Route::any('/venue/themebuilder/{id}/preview', [ThemeBuilderController::class,'preview'])->name('venue/themebuilder/preview');
    Route::any('/venue/themebuilder/create', [ThemeBuilderController::class,'create'])->name('themebuilder/create');
    Route::any('/venue/themebuilder/{id}/edit', [ThemeBuilderController::class,'edit']);
    Route::put('/venue/themebuilder/update', [ThemeBuilderController::class,'update'])->name('themebuilder.update');
    Route::post('/venue/themebuilder/store', [ThemeBuilderController::class,'store'])->name('venue.themebuilder_add');
    Route::any('/venue/themebuilder/show', [ThemeBuilderController::class,'show'])->name('themebuilder/show');
    Route::any('/venue/themebuilder/{id}/destroy', [ThemeBuilderController::class,'destroy']);
    Route::any('/venue/themebuilder/{id}/updatestatus', [ThemeBuilderController::class,'updatestatus']);




     
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

    Route::any('/venueportalrequest',[VenueController::class,'venueportalrequest'])->name('venue.venueportalrequest');
    Route::any('/venueportalrequest/{id}/updatestatus',[VenueController::class,'venueuserupdatestatus']);


});

