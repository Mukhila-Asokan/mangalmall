<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\SettingsController;
use Modules\Settings\Http\Controllers\ChecklistController;
use Modules\Settings\Http\Controllers\ChecklistCategoryController;
use Modules\Settings\Http\Controllers\ChecklistItemsController;
use Modules\Settings\Http\Controllers\EventChecklistAssignmentsController;


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
    Route::resource('settings', SettingsController::class)->names('settings');
});


Route::prefix('admin/settings')->middleware('auth:admin')->group(function () {

    Route::any('/checklist', [ChecklistController::class,'index'])->name('admin.checklist');

    Route::any('/checklistcat/create', [ChecklistCategoryController::class,'create'])->name('admin.checklistcat.create');
    Route::any('/checklistcat/store', [ChecklistCategoryController::class,'store'])->name('admin.checklistcat.store');
    Route::any('/checklistcat/edit/{id}', [ChecklistCategoryController::class,'edit'])->name('admin.checklistcat.edit');
    Route::any('/checklistcat/update/{id}', [ChecklistCategoryController::class,'update'])->name('admin.checklistcat.update');
    Route::any('/checklistcat/{id}/destroy', [ChecklistCategoryController::class,'destroy'])->name('admin.checklistcat.delete');
    Route::any('/checklistcat/{id}/updatestatus', [ChecklistCategoryController::class,'updatestatus'])->name('admin.checklistcat.updatestatus');
    Route::any('/checklistcat/show', [ChecklistCategoryController::class,'index'])->name('admin.checklistcat.index');

    Route::any('/eventchecklist/create', [EventChecklistAssignmentsController::class,'create'])->name('admin.eventchecklist.create');
    Route::any('/eventchecklist/store', [EventChecklistAssignmentsController::class,'store'])->name('admin.eventchecklist.store');
    Route::any('/eventchecklist/edit/{id}', [EventChecklistAssignmentsController::class,'edit'])->name('admin.eventchecklist.edit');
    Route::any('/eventchecklist/update/{id}', [EventChecklistAssignmentsController::class,'update'])->name('admin.eventchecklist.update');
    Route::any('/eventchecklist/{id}/destroy', [EventChecklistAssignmentsController::class,'destroy'])->name('admin.eventchecklist.delete');
    Route::any('/eventchecklist/{id}/updatestatus', [EventChecklistAssignmentsController::class,'updatestatus'])->name('admin.eventchecklist.updatestatus');
    Route::any('/eventchecklist/show', [EventChecklistAssignmentsController::class,'index'])->name('admin.eventchecklist.index');

    Route::any('/checklistitems/create', [ChecklistItemsController::class,'create'])->name('admin.checklistitems.create');
    Route::any('/checklistitems/store', [ChecklistItemsController::class,'store'])->name('admin.checklistitems.store');
    Route::any('/checklistitems/edit/{id}', [ChecklistItemsController::class,'edit'])->name('admin.checklistitems.edit');
    Route::any('/checklistitems/update/{id}', [ChecklistItemsController::class,'update'])->name('admin.checklistitems.update');
    Route::any('/checklistitems/{id}/destroy', [ChecklistItemsController::class,'destroy'])->name('admin.checklistitems.delete');
    Route::any('/checklistitems/{id}/updatestatus', [ChecklistItemsController::class,'updatestatus'])->name('admin.checklistitems.updatestatus');
    Route::any('/checklistitems/show', [ChecklistItemsController::class,'index'])->name('admin.checklistitems.index');
    Route::any('/checklistitems/getitems', [ChecklistItemsController::class,'getitems'])->name('admin.checklistitems.get');    



});