<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\SettingsController;
use Modules\Settings\Http\Controllers\ChecklistController;
use Modules\Settings\Http\Controllers\ChecklistCategoryController;
use Modules\Settings\Http\Controllers\ChecklistItemsController;
use Modules\Settings\Http\Controllers\EventChecklistAssignmentsController;
use Modules\Settings\Http\Controllers\BudgetCategoryController;
use Modules\Settings\Http\Controllers\BudgetItemsController; 
use Modules\Settings\Http\Controllers\BudgetCatAssignEventController;


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

    /*Budget*/
    Route::any('/budget', [SettingsController::class,'budget'])->name('admin.budget');

    Route::any('/budgetcat/create', [BudgetCategoryController::class,'create'])->name('admin.budgetcat.create');
    Route::any('/budgetcat/store', [BudgetCategoryController::class,'store'])->name('admin.budgetcat.store');
    Route::any('/budgetcat/edit/{id}', [BudgetCategoryController::class,'edit'])->name('admin.budgetcat.edit');
    Route::any('/budgetcat/update/{id}', [BudgetCategoryController::class,'update'])->name('admin.budgetcat.update');
    Route::any('/budgetcat/{id}/destroy', [BudgetCategoryController::class,'destroy'])->name('admin.budgetcat.delete');
    Route::any('/budgetcat/{id}/updatestatus', [BudgetCategoryController::class,'updatestatus'])->name('admin.budgetcat.updatestatus');
    Route::any('/budgetcat/show', [BudgetCategoryController::class,'index'])->name('admin.budgetcat.index');
    
    Route::any('/budgetitems/create', [BudgetItemsController::class,'create'])->name('admin.budgetitems.create');
    Route::any('/budgetitems/store', [BudgetItemsController::class,'store'])->name('admin.budgetitems.store');
    Route::any('/budgetitems/edit/{id}', [BudgetItemsController::class,'edit'])->name('admin.budgetitems.edit');
    Route::any('/budgetitems/update/{id}', [BudgetItemsController::class,'update'])->name('admin.budgetitems.update');
    Route::any('/budgetitems/{id}/destroy', [BudgetItemsController::class,'destroy'])->name('admin.budgetitems.delete');
    Route::any('/budgetitems/{id}/updatestatus', [BudgetItemsController::class,'updatestatus'])->name('admin.budgetitems.updatestatus');
    Route::any('/budgetitems/show', [BudgetItemsController::class,'index'])->name('admin.budgetitems.index');
    Route::any('/budgetitems/getitems', [BudgetItemsController::class,'getitems'])->name('admin.budgetitems.get');  
    
    Route::any('/eventbudget/create', [BudgetCatAssignEventController::class,'create'])->name('admin.eventbudget.create');
    Route::any('/eventbudget/store', [BudgetCatAssignEventController::class,'store'])->name('admin.eventbudget.store');
    Route::any('/eventbudget/edit/{id}', [BudgetCatAssignEventController::class,'edit'])->name('admin.eventbudget.edit');
    Route::any('/eventbudget/update/{id}', [BudgetCatAssignEventController::class,'update'])->name('admin.eventbudget.update');
    Route::any('/eventbudget/{id}/destroy', [BudgetCatAssignEventController::class,'destroy'])->name('admin.eventbudget.delete');
    Route::any('/eventbudget/{id}/updatestatus', [BudgetCatAssignEventController::class,'updatestatus'])->name('admin.eventbudget.updatestatus');
    Route::any('/eventbudget/show', [BudgetCatAssignEventController::class,'index'])->name('admin.eventbudget.index');

});