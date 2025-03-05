<?php

use Illuminate\Support\Facades\Route;
use Modules\Venue\Http\Controllers\VenueController;
use Modules\Venue\Http\Controllers\VenueTypeController;
use Modules\Venue\Http\Controllers\VenueSubTypeController;
use Modules\Venue\Http\Controllers\VenueAmenitiesController;
use Modules\Venue\Http\Controllers\VenueDataFieldController;
use Modules\Venue\Http\Controllers\ThemeBuilderController;
use Modules\Venue\Http\Controllers\StateController;
use Modules\Venue\Http\Controllers\DistrictController;
Use Modules\Venue\Http\Controllers\CityController;
use Modules\Venue\Http\Controllers\AreaController;
Use Modules\Venue\Http\Controllers\DeletedRecordsController;

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

use App\Http\Middleware\IsAdminRoleCheck;
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

$username = Session::get('username');
$userid = Session::get('userid');   


Route::any('/venue/create/ajaxcitylist', [VenueController::class,'ajaxcitylist'])->name('venue/create/ajaxcitylist');
Route::any('/venue/ajaxarealist', [VenueController::class,'ajaxarealist'])->name('venue.ajaxarealist');

Route::any('/venue/create/ajaxcvenuesubtypelist', [VenueController::class,'ajaxcvenuesubtypelist'])->name('venue/create/ajaxcvenuesubtypelist');

Route::prefix('admin')->middleware('admin.role')->group(function () {

    Route::any('/venue', [VenueController::class,'index'])->name('venue');
    Route::any('/venue/create', [VenueController::class,'create'])->name('venue/create');
    
    Route::post('/venue/store', [VenueController::class,'store'])->name('venue.venue_add');
    Route::any('/venue/show', [VenueController::class,'index'])->name('venue/index');
    Route::any('/venue/detailview/{id}', [VenueController::class,'detailview'])->name('venue/detailview');
    Route::any('/venue/{id}/edit', [VenueController::class,'edit'])->name('venue.edit');
    Route::any('/venue/{id}/webpage', [VenueController::class,'webpage']);
    Route::put('/venue/{id}', [VenueController::class, 'update'])->name('venue.update');
    Route::any('/venue/{id}/destroy', [VenueController::class,'destroy']);
    Route::any('/venue/{id}/updatestatus', [VenueController::class,'updatestatus']);
    Route::any('/venue/{id}/venuecontent', [VenueController::class,'venuecontent'])->name('venue/venuecontent');
    Route::any('/venue/content_add', [VenueController::class,'content_add'])->name('venue.content_add');
    Route::any('/venue/{id}/venueimage', [VenueController::class,'venueimage'])->name('venue/venueimage');
    Route::any('/venue/venueimage_add', [VenueController::class,'venueimage_add'])->name('venue.venueimage_add');
    Route::post('/venue/image-delete', [VenueController::class, 'imageDelete'])->name('venue.image_delete');
    Route::get('/venue/export', [VenueController::class,'export'])->name('venue.export');

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

    Route::any('/venue/allhall/{id}', [VenueController::class, 'allhall'])->name('venue.allhall');
    Route::any('/venue/hallcreate/{id}', [VenueController::class,'hallcreate'])->name('venue.hallcreate');
    Route::post('/venue/hallstore', [VenueController::class,'hallstore'])->name('venue.hall_add');
    Route::any('/venue/{id}/hallshow', [VenueController::class,'hallshow'])->name('venue/hallshow');
    Route::any('/venue/hall/{id}/edit', [VenueController::class,'halledit']);
    Route::put('/venue/hall/update/{id}', [VenueController::class,'hallupdate'])->name('venue.hallupdate');
    Route::any('/venue/hall/{id}/destroy', [VenueController::class,'halldestroy']);
    Route::any('/venue/hall/{id}/updatestatus', [VenueController::class,'hallupdatestatus']);



     
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
    Route::any('/venueadminlist',[VenueController::class,'venueadminlist'])->name('venue.venueadminlist');
    Route::any('/venue/comments',[VenueController::class,'venueComments'])->name('venue.comments');
    Route::get('/venue/comment/{action}/{venueId}',[VenueController::class,'venueApproveComment'])->name('venue.approve.comments');
    Route::get('/venue/comments/bulk-action',[VenueController::class,'venueBulkAction'])->name('bulk.comments.action');

    /*State*/

    Route::any('/state', [StateController::class,'index'])->name('venue.state');
    Route::any('/state/create', [StateController::class,'create'])->name('venue.state/create');
    Route::any('/state/{id}/edit', [StateController::class,'edit']);
    Route::put('/state/update/{id}', [StateController::class,'update'])->name('state.update');
    Route::post('/state/store', [StateController::class,'store'])->name('venue.state_add');   
    Route::any('/state/{id}/destroy', [StateController::class,'destroy']);
    Route::any('/state/{id}/updatestatus', [StateController::class,'updatestatus']);

    /*District*/
    Route::any('/district', [DistrictController::class,'index'])->name('venue.district');
    Route::any('/district/create', [DistrictController::class,'create'])->name('venue.district/create');
    Route::any('/district/{id}/edit', [DistrictController::class,'edit']);
    Route::put('/district/update/{id}', [DistrictController::class,'update'])->name('districts.update');
    Route::post('/district/store', [DistrictController::class,'store'])->name('venue.district_add');   
    Route::any('/district/{id}/destroy', [DistrictController::class,'destroy']);
    Route::any('/district/{id}/updatestatus', [DistrictController::class,'updatestatus']);

    /*City*/
    Route::any('/city', [CityController::class,'index'])->name('venue.city');
    Route::any('/city/create', [CityController::class,'create'])->name('venue.city/create');
    Route::any('/city/{id}/edit', [CityController::class,'edit']);
    Route::put('/city/update/{id}', [CityController::class,'update'])->name('venue.city_update');
    Route::post('/city/store', [CityController::class,'store'])->name('venue.city_add');   
    Route::any('/city/{id}/destroy', [CityController::class,'destroy']);
    Route::any('/city/{id}/updatestatus', [CityController::class,'updatestatus']);


    /*Area*/
    Route::any('/area', [AreaController::class,'index'])->name('venue.area');
    Route::any('/area/create', [AreaController::class,'create'])->name('venue.area/create');
    Route::any('/area/{id}/edit', [AreaController::class,'edit']);
    Route::put('/area/update/{id}', [AreaController::class,'update'])->name('venue.area_update');
    Route::post('/area/store', [AreaController::class,'store'])->name('venue.area_add');   
    Route::any('/area/{id}/destroy', [AreaController::class,'destroy']);
    Route::any('/area/{id}/updatestatus', [AreaController::class,'updatestatus']);


    /*DeletedRecordsController*/

    Route::any('/deletedrecords', [DeletedRecordsController::class,'index'])->name('venue.deletedrecords');
    Route::any('/menu/restore/{id}', [DeletedRecordsController::class, 'restoredata'])->name('menus.restore');
    Route::any('/menu/deletepermanent/{id}', [DeletedRecordsController::class, 'deletepermanent'])->name('menus.deletepermanent');
    Route::any('/menu/deletedview/{id}', [DeletedRecordsController::class, 'deletedview'])->name('menus.deletedview');
    Route::any('/menu/bulkAction', [DeletedRecordsController::class, 'bulkAction'])->name('menus.bulkAction');


});

Route::get('/get-districts', [VenueController::class, 'getDistricts'])->name('get.districts');

Route::get('/get-cities', [VenueController::class, 'getCities'])->name('get.cities');

/*Route::prefix('admin')->middleware('auth:admin', HandleInertiaRequests::class)->group(function () {

    Route::any('/venue/{id}/bookingdetails', [VenueController::class,'bookingdetails']);
    
});*/

Route::middleware(HandleInertiaRequests::class)->group(function () {  
    Route::prefix('admin')->middleware(['auth:admin'])->group(function () { 
        Route::get('/venue/{id}/bookingdetails', [VenueController::class, 'bookingdetails'])->name('admin.venue.bookingdetails');
       

    });

    
});