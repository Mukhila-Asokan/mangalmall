<?php

use Illuminate\Support\Facades\Route;
use Modules\StaffManagement\Http\Controllers\StaffManagementController;
Use Modules\StaffManagement\Http\Controllers\DepartmentsController;
Use Modules\StaffManagement\Http\Controllers\RolesController;

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
    Route::resource('staffmanagement', StaffManagementController::class)->names('staffmanagement');
});
*/


Route::prefix('admin')->middleware('auth:admin')->group(function () {



    Route::any('/staff',[StaffManagementController::class, 'index'])->name('admin/staff');
    Route::any('/staff/create',[StaffManagementController::class, 'create'])->name('staff/create');
    Route::post('/staff/store', [StaffManagementController::class,'store'])->name('staff.staff_add');
    Route::any('/staff/{id}/edit', [StaffManagementController::class,'edit']);
    Route::put('/staff/update', [StaffManagementController::class,'update'])->name('staff.update');
    Route::any('/staff/{id}/destroy', [StaffManagementController::class,'destroy']);
    Route::any('/staff/{id}/updatestatus', [StaffManagementController::class,'updatestatus']);

    
    Route::any('/staff/getroleusingdepid', [StaffManagementController::class,'getroleusingdepid'])->name('staff.getroleusingdepid');
    Route::any('/staff/ajaxstore', [StaffManagementController::class,'ajaxstore'])->name('staff.ajaxstore');
    Route::any('/staff/detailview/{id}',[StaffManagementController::class,'detailview'])->name('staff.detailview');
    Route::any('/staff/ajaxqualification',[StaffManagementController::class,'ajaxqualification'])->name('staff.ajaxqualification');
    Route::any('/staff/ajaxworkingdetails',[StaffManagementController::class,'ajaxworkingdetails'])->name('staff.ajaxworkingdetails');
    Route::any('/staff/ajaxskillset',[StaffManagementController::class,'ajaxskillset'])->name('staff.ajaxskillset');
    Route::any('/staff/ajaxdocuments',[StaffManagementController::class,'ajaxdocuments'])->name('staff.ajaxdocuments');
    
    Route::any('/staff/ajaxphotoadd',[StaffManagementController::class,'ajaxphotoadd'])->name('staff.ajaxphotoadd');
    Route::any('/staff/profile',[StaffManagementController::class, 'profile'])->name('staff/profile');
    
    Route::any('/staff/departments',[DepartmentsController::class, 'index'])->name('staff/departments');

    Route::any('/staff/departments/create', [DepartmentsController::class,'create'])->name('departments/create');
    Route::any('/staff/departments/{id}/edit', [DepartmentsController::class,'edit']);
    Route::put('/staff/departments/update', [DepartmentsController::class,'update'])->name('departments.update');
    Route::post('/staff/departments/store', [DepartmentsController::class,'store'])->name('departments.dep_add');
    Route::any('/staff/departments/show', [DepartmentsController::class,'show'])->name('departments/show');
    Route::any('/staff/departments/{id}/destroy', [DepartmentsController::class,'destroy']);
    Route::any('/staff/departments/{id}/updatestatus', [DepartmentsController::class,'updatestatus']);


    Route::any('/staff/roles',[RolesController::class, 'index'])->name('staff/roles');
    Route::any('/staff/roles/create', [RolesController::class,'create'])->name('roles/create');
    Route::any('/staff/roles/{id}/edit', [RolesController::class,'edit']);
    Route::put('/staff/roles/update', [RolesController::class,'update'])->name('roles.update');
    Route::post('/staff/roles/store', [RolesController::class,'store'])->name('roles.role_add');
    Route::any('/staff/roles/show', [RolesController::class,'show'])->name('roles/show');
    Route::any('/staff/roles/{id}/destroy', [RolesController::class,'destroy']);
    Route::any('/staff/roles/{id}/updatestatus', [RolesController::class,'updatestatus']);

});