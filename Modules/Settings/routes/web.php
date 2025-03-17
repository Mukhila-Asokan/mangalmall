<?php

use Illuminate\Support\Facades\Route;
use Modules\Settings\Http\Controllers\SettingsController;
use Modules\Settings\Http\Controllers\ChecklistController;

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
    Route::any('/checklist/create', [ChecklistController::class,'create'])->name('admin.checklist.create');
    Route::any('/checklist/store', [ChecklistController::class,'store'])->name('admin.checklist.store');
    Route::any('/checklist/edit/{id}', [ChecklistController::class,'edit'])->name('admin.checklist.edit');
    Route::any('/checklist/update/{id}', [ChecklistController::class,'update'])->name('admin.checklist.update');
    Route::any('/checklist/delete/{id}', [ChecklistController::class,'destroy'])->name('admin.checklist.delete');
    Route::any('/checklist/updatestatus/{id}', [ChecklistController::class,'updatestatus'])->name('admin.checklist.updatestatus');
   
});