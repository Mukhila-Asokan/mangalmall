<?php

use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\OccasionTypeController;
use App\Http\Controllers\ReligionController;
Use App\Http\Controllers\OccasionDataFieldController;
use App\Http\Middleware\IsAdminRoleCheck;
Use Modules\Venue\Http\Controllers\MenuController;

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin/auth/login');
});

Route::prefix('admin')->middleware('guest:admin')->group(function () {

 

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::any('authcheck', [LoginController::class, 'authcheck'])->name('admin.authcheck');

});

Route::get('/adminrole', [RoleController::class, 'redirectRoutes'])->name('adminrole');

// Route::prefix('admin')->middleware(IsAdminRoleCheck::class)->group(function () {
Route::prefix('admin')->group(function () {

 /*   Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');*/


    Route::any('/dashboard', [DashboardController::class, 'dashboard'])->name('admin/dashboard');
    Route::get('/dashboard/data',[DashboardController::class, 'dashboardChart'])->name('admin/get-dashboard-data');
    Route::get('/view/all/enquiries', [DashboardController::class, 'allEnquiries'])->name('admin/get.all.enquiries');
    Route::get('update/enquiry/status/{id}', [DashboardController::class, 'updateEnquiryStatus'])->name('admin/update.enquiry.status');


    /*Occasion Type */
     Route::any('/occasion', [OccasionTypeController::class, 'index'])->name('admin/occasion');
     Route::any('/occasion/create', [OccasionTypeController::class, 'create'])->name('admin/occasion/create');
     Route::any('/occasion/store', [OccasionTypeController::class, 'store'])->name('admin/occasion/store');
     Route::any('/occasion/{id}/destroy', [OccasionTypeController::class,'destroy']);
     Route::any('/occasion/{id}/updatestatus', [OccasionTypeController::class,'updatestatus']);
     Route::any('/occasion/{id}/edit', [OccasionTypeController::class,'edit']);
     Route::put('/occasion/update', [OccasionTypeController::class,'update'])->name('admin/occasion/update');


    /*occasiondatafield*/

    Route::any('/occasiondatafield', [OccasionDataFieldController::class, 'index'])->name('admin/occasiondatafield');
    Route::any('/occasiondatafield/create', [OccasionDataFieldController::class, 'create'])->name('admin/occasiondatafield/create');
    Route::any('/occasiondatafield/store', [OccasionDataFieldController::class, 'store'])->name('admin/occasiondatafield/store');
    Route::any('/occasiondatafield/{id}/destroy', [OccasionDataFieldController::class,'destroy']);
    Route::any('/occasiondatafield/{id}/updatestatus', [OccasionDataFieldController::class,'updatestatus']);
    Route::any('/occasiondatafield/{id}/edit', [OccasionDataFieldController::class,'edit']);
    Route::put('/occasiondatafield/update/{id}', [OccasionDataFieldController::class,'update'])->name('admin/occasiondatafield/update');



     Route::any('/religion', [ReligionController::class, 'index'])->name('admin/religion');
     Route::any('/religion/create', [ReligionController::class, 'create'])->name('religion.create');
     Route::any('/religion/store', [ReligionController::class, 'store'])->name('religion.store');
     Route::any('/religion/{id}/destroy', [ReligionController::class,'destroy']);
     Route::any('/religion/{id}/updatestatus', [ReligionController::class,'updatestatus']);
     Route::any('/religion/{id}/edit', [ReligionController::class,'edit']);
     Route::put('/religion/update/{id}', [ReligionController::class,'update'])->name('religion.update');


     Route::any('/menu', [MenuController::class, 'index'])->name('admin.menu');
     Route::any('/menu/create', [MenuController::class, 'create'])->name('menu.create');
     Route::any('/menu/store', [MenuController::class, 'store'])->name('menu.store');
     Route::any('/menu/{id}/destroy', [MenuController::class,'destroy']);
     Route::any('/menu/{id}/updatestatus', [MenuController::class,'updatestatus']);
     Route::any('/menu/{id}/edit', [MenuController::class,'edit']);
     Route::put('/menu/update/{id}', [MenuController::class,'update'])->name('menu.update');
    
    

     
     Route::any('staff/dashboard', [StaffController::class, 'index'])->name('admin/staff/dashboard');
     Route::any('/changepassword', [DashboardController::class, 'changepassword'])->name('admin.changepassword');
     Route::any('/passwordupdate', [DashboardController::class, 'passwordupdate'])->name('admin.passwordupdate');

    Route::any('/notification', [DashboardController::class, 'notifications'])->name('admin.notifications');

   

    Route::any('logout', [LoginController::class, 'destroy'])->name('admin/logout');

});