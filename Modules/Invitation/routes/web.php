<?php

use Illuminate\Support\Facades\Route;
use Modules\Invitation\Http\Controllers\InvitationController;
use Modules\Invitation\Http\Controllers\InvitationModelController;
use Modules\Invitation\Http\Controllers\InvitationSizeController;

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

Route::group([], function () {
    Route::resource('invitation', InvitationController::class)->names('invitation');
});


Route::prefix('admin/invitation')->middleware('auth:admin')->group(function () {

    Route::any('/invitationmodel', [InvitationModelController::class,'index'])->name('invitation/invitationmodel');
    Route::any('/invitationmodel/create', [InvitationModelController::class,'create'])->name('invitationmodel/create');
    Route::any('/invitationmodel/{id}/edit', [InvitationModelController::class,'edit']);
    Route::put('/invitationmodel/update', [InvitationModelController::class,'update'])->name('invitationmodel.update');
    Route::post('/invitationmodel/store', [InvitationModelController::class,'store'])->name('invitationmodel.model_add');
    Route::any('/invitationmodel/show', [InvitationModelController::class,'show'])->name('invitationmodel/show');
    Route::any('/invitationmodel/{id}/destroy', [InvitationModelController::class,'destroy']);
    Route::any('/invitationmodel/{id}/updatestatus', [InvitationModelController::class,'updatestatus']);

     Route::any('/invitationsize', [InvitationSizeController::class,'index'])->name('invitation/invitationsize');
      Route::any('/invitationsize/create', [InvitationSizeController::class,'create'])->name('invitationsize/create');
    Route::any('/invitationsize/{id}/edit', [InvitationSizeController::class,'edit']);
    Route::put('/invitationsize/update', [InvitationSizeController::class,'update'])->name('invitationsize.update');
    Route::post('/invitationsize/store', [InvitationSizeController::class,'store'])->name('invitationsize.model_add');
    Route::any('/invitationsize/show', [InvitationSizeController::class,'show'])->name('invitationsize/show');
    Route::any('/invitationsize/{id}/destroy', [InvitationSizeController::class,'destroy']);
    Route::any('/invitationsize/{id}/updatestatus', [InvitationSizeController::class,'updatestatus']);




     Route::any('/invitationcolor', [InvitationModelController::class,'index'])->name('invitation/invitationcolor');

     Route::any('/printingmethod', [InvitationModelController::class,'index'])->name('invitation/printingmethod');

     Route::any('/material', [InvitationModelController::class,'index'])->name('invitation/material');

     Route::any('/budget', [InvitationModelController::class,'index'])->name('invitation/budget');

});