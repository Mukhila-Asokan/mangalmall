<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Support\Facades\Route;
use Modules\VenueAdmin\Http\Controllers\VenueAdminController;
use Modules\VenueAdmin\Http\Controllers\VenueUserProfileController;
use Modules\VenueAdmin\Http\Controllers\VenueBookingController;
use Illuminate\Foundation\Configuration\Middleware;
use Modules\VenueAdmin\Http\Middleware\VenueAdminMiddleware;
use App\Http\Middleware\FlashMessageMiddleware;
use Modules\VenueAdmin\Http\Controllers\StaffController;
use Modules\VenueAdmin\Http\Controllers\BookingAdonsController;
use Modules\VenueAdmin\Http\Controllers\VenuePricingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::group([], function () {
    Route::resource('venueadmin', VenueAdminController::class)->names('venueadmin');
});*/


Route::get('/venue/login',[VenueAdminController::class, 'index'])->name('venue/login');
Route::any('/venue/mobileotp',[VenueAdminController::class, 'mobileotp'])->name('mobileotp');
Route::any('/venue/sendotp',[VenueAdminController::class, 'sendotp'])->name('venueadmin/sendotp');
Route::any('/venue/logincheck',[VenueAdminController::class, 'logincheck'])->name('venue/logincheck');
Route::any('/venueadmin/inactiveuser',[VenueAdminController::class, 'inactiveuser'])->name('venueadmin/inactiveuser');
Route::any('/venue/register',[VenueAdminController::class, 'register'])->name('venueadmin/register');
Route::post('/venue/newaccountadd',[VenueAdminController::class, 'newaccountadd'])->name('venueadmin/newaccountadd');

Route::prefix('venueadmin')->middleware([VenueAdminMiddleware::class, FlashMessageMiddleware::class])->group(function () { 

    Route::any('/dashboard',[VenueAdminController::class, 'dashboard'])->name('venueadmin/dashboard');

    Route::any('/userprofile',[VenueUserProfileController::class, 'index'])->name('venueadmin.userprofile');
    Route::any('/userprofileupdate',[VenueUserProfileController::class, 'store'])->name('venueadmin/userprofileupdate');
    Route::any('/changemobileno',[VenueUserProfileController::class, 'changemobileno'])->name('venueadmin.changemobileno');
    Route::any('/sendrequestchangemobileno',[VenueUserProfileController::class, 'sendrequestchangemobileno'])->name('venueadmin.sendrequestchangemobileno');

    Route::any('/venueadd',[VenueAdminController::class, 'storevenue'])->name('venueadmin/venueadd');
    Route::any('/venueupdate/{id}',[VenueAdminController::class, 'updateVenue'])->name('venueadmin/venueupdate');

     Route::any('/addvenue',[VenueAdminController::class, 'createvenue'])->name('venueadmin/create');
     Route::any('/editvenue/{id}',[VenueAdminController::class, 'editvenue'])->name('venueadmin/edit');
     Route::any('/viewvenue/{id}',[VenueAdminController::class, 'viewvenue'])->name('venueadmin/view');
     Route::any('/venue/gallery/{id}',[VenueAdminController::class, 'venueGallery'])->name('venueadmin/venue/gallery');
     Route::any('/venue/venueimage_add', [VenueAdminController::class,'venueimageAdd'])->name('venueadmin/venueimage_add');
    Route::any('/venuelist',[VenueAdminController::class, 'show'])->name('venueadmin/venuelist');
    Route::post('/venue/image-delete', [VenueAdminController::class, 'imageDelete'])->name('venueadmin/image_delete');
    Route::any('/venue/{id}/venuecontent', [VenueAdminController::class,'venuecontent'])->name('venueadmin/venuecontent');
    Route::any('/venue/content_add', [VenueAdminController::class,'contentAdd'])->name('venueadmin/content_add');

    Route::any('/venuebooking/{id}/add',[VenueBookingController::class, 'create']);
    Route::any('/venuebooking/addnewevents',[VenueBookingController::class, 'addnewevents']);
    Route::any('/venuebooking/updatenewevents',[VenueBookingController::class, 'updatenewevents']);
    Route::any('/venuebooking/events',[VenueBookingController::class, 'getevents']);
    Route::any('/venuebooking/{id}/edit',[VenueBookingController::class, 'edit']);
    
    Route::any('/venuebooking/eventslist',[VenueBookingController::class, 'index'])->name('venuebooking.eventslist');

    Route::any('/venuebooking/list',[VenueBookingController::class, 'show'])->name('venuebooking.list');
    
    Route::any('/bookingadons',[BookingAdonsController::class, 'index'])->name('venue.bookingadons');
    Route::any('/bookingadons/create',[BookingAdonsController::class, 'create'])->name('bookingadons.create');
    Route::post('/bookingadons/store',[BookingAdonsController::class, 'store'])->name('bookingadons.add');
    Route::any('/bookingadons/{id}/edit', [BookingAdonsController::class,'edit']);
    Route::put('/bookingadons/update/{id}', [BookingAdonsController::class,'update'])->name('bookingadons.update');
    Route::any('/bookingadons/{id}/destroy', [BookingAdonsController::class,'destroy']);
    Route::any('/bookingadons/{id}/updatestatus', [BookingAdonsController::class,'updatestatus']);


    Route::any('/venuepricing',[VenuePricingController::class, 'index'])->name('venue.pricing');
    Route::any('/venuepricing/create',[VenuePricingController::class, 'create'])->name('venuepricing.create');
    Route::post('/venuepricing/store',[VenuePricingController::class, 'store'])->name('venuepricing.add');
    Route::any('/venuepricing/{id}/edit', [VenuePricingController::class,'edit']);
    Route::put('/venuepricing/update/{id}', [VenuePricingController::class,'update'])->name('venuepricing.update');
    Route::any('/venuepricing/{id}/destroy', [VenuePricingController::class,'destroy']);
    Route::any('/venuepricing/{id}/updatestatus', [VenuePricingController::class,'updatestatus']);
    Route::get('venuepricing/getRate/{id}', [VenuePricingController::class, 'getRate']);
    Route::any('/venuepricing/{id}/',[VenuePricingController::class, 'index'])->name('venue.pricing');

     Route::any('/logout',[VenueAdminController::class, 'destroy'])->name('venueadmin/logout');

    //Staff
    Route::get('/list/staffs', [StaffController::class, 'index'])->name('venueadmin.list.staff');
    Route::get('/add/staff', [StaffController::class, 'add'])->name('venueadmin.add.staff');
    Route::post('/store/staff', [StaffController::class, 'store'])->name('venueadmin.store.staff');
    Route::get('/edit/staff/{id}', [StaffController::class, 'edit'])->name('venueadmin.edit.staff');
    Route::post('/update/staff', [StaffController::class, 'update'])->name('venueadmin.update.staff');
    Route::get('/delete/staff/{id}', [StaffController::class, 'delete'])->name('venueadmin.delete.staff');
});