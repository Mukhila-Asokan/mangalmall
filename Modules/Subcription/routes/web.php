<?php

use Illuminate\Support\Facades\Route;
use Modules\Subcription\Http\Controllers\SubcriptionController;
use Modules\Subcription\Http\Controllers\SubscriptionPlanController;
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
    Route::resource('subcription', SubcriptionController::class)->names('subcription');
});

Route::prefix('admin/subcription')->middleware('auth:admin')->group(function () {

    Route::any('/subcriptionplan', [SubscriptionPlanController::class,'index'])->name('subcriptionplan');
    Route::any('/subcriptionplan/create', [SubscriptionPlanController::class,'create'])->name('subcriptionplan.create');
    Route::any('/subcriptionplan/{id}/edit', [SubscriptionPlanController::class,'edit']);
    Route::put('/subcriptionplan/update/{id}', [SubscriptionPlanController::class,'update'])->name('subcriptionplan.plan_update');
    Route::post('/subcriptionplan/store', [SubscriptionPlanController::class,'store'])->name('subcriptionplan.plan_add');
    Route::any('/subcriptionplan/show', [SubscriptionPlanController::class,'show'])->name('subcriptionplan/show');
    Route::any('/subcriptionplan/{id}/destroy', [SubscriptionPlanController::class,'destroy']);
    Route::any('/subcriptionplan/{id}/updatestatus', [SubscriptionPlanController::class,'updatestatus']);


});