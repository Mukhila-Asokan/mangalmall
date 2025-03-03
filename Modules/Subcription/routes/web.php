<?php

use Illuminate\Support\Facades\Route;
use Modules\Subcription\Http\Controllers\SubcriptionController;
use Modules\Subcription\Http\Controllers\SubscriptionPlanController;
use Modules\Subcription\Http\Controllers\UserMenuController;
use Modules\Subcription\Http\Controllers\SubscriberPermissionController;
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


    Route::any('/usermenu', [UserMenuController::class,'index'])->name('admin.usermenu');
    Route::any('/usermenu/create', [UserMenuController::class,'create'])->name('usermenu.create');
    Route::any('/usermenu/{id}/edit', [UserMenuController::class,'edit']);
    Route::put('/usermenu/update/{id}', [UserMenuController::class,'update'])->name('usermenu.menu_update');
    Route::post('/usermenu/store', [UserMenuController::class,'store'])->name('usermenu.menu_add');
    Route::any('/usermenu/show', [UserMenuController::class,'show'])->name('usermenu/show');
    Route::any('/usermenu/{id}/destroy', [UserMenuController::class,'destroy']);
    Route::any('/usermenu/{id}/updatestatus', [UserMenuController::class,'updatestatus']);


    Route::any('/modulepermission', [UserMenuController::class,'index'])->name('admin.modulepermission');
    Route::any('/modulepermission/create', [UserMenuController::class,'create'])->name('modulepermission.create');
    Route::any('/modulepermission/{id}/edit', [UserMenuController::class,'edit']);
    Route::put('/modulepermission/update/{id}', [UserMenuController::class,'update'])->name('modulepermission.menu_update');
    Route::post('/modulepermission/store', [UserMenuController::class,'store'])->name('modulepermission.menu_add');
    Route::any('/modulepermission/show', [UserMenuController::class,'show'])->name('modulepermission/show');
    Route::any('/modulepermission/{id}/destroy', [UserMenuController::class,'destroy']);
    Route::any('/modulepermission/{id}/updatestatus', [UserMenuController::class,'updatestatus']);

    /* subscriptionmenupermission */
    Route::any('/subscriptionmenupermission', [SubscriberPermissionController::class,'index'])->name('admin.subscriptionmenupermission');
    Route::any('/subscriptionmenupermission/create', [SubscriberPermissionController::class,'create'])->name('subscriptionmenupermission.create');
    Route::any('/subscriptionmenupermission/{id}/edit', [SubscriberPermissionController::class,'edit']);
    Route::put('/subscriptionmenupermission/update/{id}', [SubscriberPermissionController::class,'update'])->name('subscriptionmenupermission.permission_update');
    Route::post('/subscriptionmenupermission/store', [SubscriberPermissionController::class,'store'])->name('subscriptionmenupermission.permission_add');
    Route::any('/subscriptionmenupermission/show', [SubscriberPermissionController::class,'show'])->name('subscriptionmenupermission/show');
    Route::any('/subscriptionmenupermission/{id}/destroy', [SubscriberPermissionController::class,'destroy']);
    Route::any('/subscriptionmenupermission/{id}/updatestatus', [SubscriberPermissionController::class,'updatestatus']);

});