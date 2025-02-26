<?php

use Illuminate\Support\Facades\Route;
use Modules\Invitation\Http\Controllers\InvitationController;
use Modules\Invitation\Http\Controllers\InvitationModelController;
use Modules\Invitation\Http\Controllers\InvitationSizeController;
use Modules\Invitation\Http\Controllers\InvitationColorController;
use Modules\Invitation\Http\Controllers\InvitationPrintingMaterialController;
use Modules\Invitation\Http\Controllers\InvitationPrintingMethodController;
use Modules\Invitation\Http\Controllers\InvitationBudgetController;
use Modules\Invitation\Http\Controllers\InvitationSilhoutteController;
use Modules\Invitation\Http\Controllers\InvitationCardThicknessController;
Use Modules\Invitation\Http\Controllers\InvitationWebpageController;
Use Modules\Invitation\Http\Controllers\CardTemplateController;

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
    Route::any('/invitationsize/create', [InvitationSizeController::class,'create'])->name('invitationsize.create');
    Route::any('/invitationsize/{id}/edit', [InvitationSizeController::class,'edit']);
    Route::put('/invitationsize/update/{id}', [InvitationSizeController::class,'update'])->name('invitation.size_update');
    Route::post('/invitationsize/store', [InvitationSizeController::class,'store'])->name('invitation.size_add');
    Route::any('/invitationsize/show', [InvitationSizeController::class,'show'])->name('invitationsize/show');
    Route::any('/invitationsize/{id}/destroy', [InvitationSizeController::class,'destroy']);
    Route::any('/invitationsize/{id}/updatestatus', [InvitationSizeController::class,'updatestatus']);

    Route::any('/invitationcolor', [InvitationColorController::class,'index'])->name('invitation.invitationcolor');
    Route::any('/invitationcolor/create', [InvitationColorController::class,'create'])->name('invitationcolor.create');
    Route::any('/invitationcolor/{id}/edit', [InvitationColorController::class,'edit']);
    Route::put('/invitationcolor/update/{id}', [InvitationColorController::class,'update'])->name('invitation.color_update');
    Route::post('/invitationcolor/store', [InvitationColorController::class,'store'])->name('invitation.color_add');
    Route::any('/invitationcolor/show', [InvitationColorController::class,'show'])->name('invitationcolor/show');
    Route::any('/invitationcolor/{id}/destroy', [InvitationColorController::class,'destroy']);
    Route::any('/invitationcolor/{id}/updatestatus', [InvitationColorController::class,'updatestatus']);



    Route::any('/printingmethod', [InvitationPrintingMethodController::class,'index'])->name('invitation.printingmethod');
    Route::any('/printingmethod/create', [InvitationPrintingMethodController::class,'create'])->name('printingmethod.create');
    Route::any('/printingmethod/{id}/edit', [InvitationPrintingMethodController::class,'edit']);
    Route::put('/printingmethod/update/{id}', [InvitationPrintingMethodController::class,'update'])->name('printingmethod.update');
    Route::post('/printingmethod/store', [InvitationPrintingMethodController::class,'store'])->name('printingmethod.add');
    Route::any('/printingmethod/{id}/destroy', [InvitationPrintingMethodController::class,'destroy']);
    Route::any('/printingmethod/{id}/updatestatus', [InvitationPrintingMethodController::class,'updatestatus']);


    Route::any('/printingmaterial', [InvitationPrintingMaterialController::class,'index'])->name('invitation.printingmaterial');
    Route::any('/printingmaterial/create', [InvitationPrintingMaterialController::class,'create'])->name('printingmaterial.create');
    Route::any('/printingmaterial/{id}/edit', [InvitationPrintingMaterialController::class,'edit']);
    Route::put('/printingmaterial/update/{id}', [InvitationPrintingMaterialController::class,'update'])->name('printingmaterial.update');
    Route::post('/printingmaterial/store', [InvitationPrintingMaterialController::class,'store'])->name('printingmaterial.add');    
    Route::any('/printingmaterial/{id}/destroy', [InvitationPrintingMaterialController::class,'destroy']);
    Route::any('/printingmaterial/{id}/updatestatus', [InvitationPrintingMaterialController::class,'updatestatus']);

    Route::any('/budget', [InvitationBudgetController::class,'index'])->name('invitation.budget');
    Route::any('/budget/create', [InvitationBudgetController::class,'create'])->name('budget.create');
    Route::any('/budget/{id}/edit', [InvitationBudgetController::class,'edit']);
    Route::put('/budget/update/{id}', [InvitationBudgetController::class,'update'])->name('budget.update');
    Route::post('/budget/store', [InvitationBudgetController::class,'store'])->name('budget.add');    
    Route::any('/budget/{id}/destroy', [InvitationBudgetController::class,'destroy']);
    Route::any('/budget/{id}/updatestatus', [InvitationBudgetController::class,'updatestatus']);

    /*invitation.silhouette*/

    Route::any('/silhouette', [InvitationSilhoutteController::class,'index'])->name('invitation.silhouette');
    Route::any('/silhouette/create', [InvitationSilhoutteController::class,'create'])->name('silhouette.create');
    Route::any('/silhouette/{id}/edit', [InvitationSilhoutteController::class,'edit']);
    Route::put('/silhouette/update/{id}', [InvitationSilhoutteController::class,'update'])->name('silhouette.update');
    Route::post('/silhouette/store', [InvitationSilhoutteController::class,'store'])->name('silhouette.add');    
    Route::any('/silhouette/{id}/destroy', [InvitationSilhoutteController::class,'destroy']);
    Route::any('/silhouette/{id}/updatestatus', [InvitationSilhoutteController::class,'updatestatus']);


    /*invitation.cardthickness */
    Route::any('/cardthickness', [InvitationCardThicknessController::class,'index'])->name('invitation.cardthickness');
    Route::any('/cardthickness/create', [InvitationCardThicknessController::class,'create'])->name('cardthickness.create');
    Route::any('/cardthickness/{id}/edit', [InvitationCardThicknessController::class,'edit']);
    Route::put('/cardthickness/update/{id}', [InvitationCardThicknessController::class,'update'])->name('cardthickness.update');
    Route::post('/cardthickness/store', [InvitationCardThicknessController::class,'store'])->name('cardthickness.add');    
    Route::any('/cardthickness/{id}/destroy', [InvitationCardThicknessController::class,'destroy']);
    Route::any('/cardthickness/{id}/updatestatus', [InvitationCardThicknessController::class,'updatestatus']);

    
    /*invitation.Webpage */
    Route::any('/webpage', [InvitationWebpageController::class,'index'])->name('invitation.webpage');
    Route::any('/webpage/create', [InvitationWebpageController::class,'create'])->name('webpage.create');
    Route::any('/webpage/{id}/edit', [InvitationWebpageController::class,'edit']);
    Route::put('/webpage/update/{id}', [InvitationWebpageController::class,'update'])->name('webpage.update');
    Route::post('/webpage/store', [InvitationWebpageController::class,'store'])->name('webpage.add');    
    Route::any('/webpage/{id}/destroy', [InvitationWebpageController::class,'destroy']);
    Route::any('/webpage/{id}/updatestatus', [InvitationWebpageController::class,'updatestatus']);


     /*invitation.Card Design */
     Route::any('/cardtemplate', [CardTemplateController::class,'index'])->name('invitation.cardtemplate');
    Route::any('/cardtemplate/create', [CardTemplateController::class,'create'])->name('cardtemplate.create');
    Route::any('/cardtemplate/{id}/edit', [CardTemplateController::class,'edit']);
    Route::put('/cardtemplate/update/{id}', [CardTemplateController::class,'update'])->name('cardtemplate.update');
    Route::post('/cardtemplate/store', [CardTemplateController::class,'store'])->name('cardtemplate.add');    
    Route::any('/cardtemplate/{id}/destroy', [CardTemplateController::class,'destroy']);
    Route::any('/cardtemplate/{id}/updatestatus', [CardTemplateController::class,'updatestatus']);

});