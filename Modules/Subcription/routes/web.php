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

Route::prefix('admin/subscription')->middleware('auth:admin')->group(function () {

    Route::any('/subscriptionplan', [SubscriptionPlanController::class,'index'])->name('subcriptionplan');
    Route::any('/subscriptionplan/create', [SubscriptionPlanController::class,'create'])->name('subcriptionplan.create');
    Route::any('/subscriptionplan/{id}/edit', [SubscriptionPlanController::class,'edit']);
    Route::put('/subscriptionplan/update/{id}', [SubscriptionPlanController::class,'update'])->name('subcriptionplan.plan_update');
    Route::post('/subscriptionplan/store', [SubscriptionPlanController::class,'store'])->name('subcriptionplan.plan_add');
    Route::any('/subscriptionplan/show', [SubscriptionPlanController::class,'show'])->name('subcriptionplan/show');
    Route::any('/subscriptionplan/{id}/destroy', [SubscriptionPlanController::class,'destroy']);
    Route::any('/subscriptionplan/{id}/updatestatus', [SubscriptionPlanController::class,'updatestatus']);


});