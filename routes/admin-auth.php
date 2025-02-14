<?php

use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\OccasionTypeController;
use App\Http\Controllers\ReligionController;


use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin/auth/login');
});

Route::prefix('admin')->middleware('guest:admin')->group(function () {

 

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
    Route::any('authcheck', [LoginController::class, 'authcheck'])->name('admin.authcheck');

});

Route::get('/adminrole', [RoleController::class, 'redirectRoutes'])->name('adminrole');

Route::prefix('admin')->middleware('auth:admin')->group(function () {

 /*   Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');*/


     Route::any('/dashboard', [DashboardController::class, 'index'])->name('admin/dashboard');
     
     Route::any('/occasion', [OccasionTypeController::class, 'index'])->name('admin/occasion');
     Route::any('/occasion/create', [OccasionTypeController::class, 'create'])->name('admin/occasion/create');
     Route::any('/occasion/store', [OccasionTypeController::class, 'store'])->name('admin/occasion/store');
     Route::any('/occasion/{id}/destroy', [OccasionTypeController::class,'destroy']);
     Route::any('/occasion/{id}/updatestatus', [OccasionTypeController::class,'updatestatus']);
     Route::any('/occasion/{id}/edit', [OccasionTypeController::class,'edit']);
     Route::put('/occasion/update', [OccasionTypeController::class,'update'])->name('admin/occasion/update');

     Route::any('/religion', [ReligionController::class, 'index'])->name('admin/religion');
     Route::any('/religion/create', [ReligionController::class, 'create'])->name('religion.create');
     Route::any('/religion/store', [ReligionController::class, 'store'])->name('religion.store');
     Route::any('/religion/{id}/destroy', [ReligionController::class,'destroy']);
     Route::any('/religion/{id}/updatestatus', [ReligionController::class,'updatestatus']);
     Route::any('/religion/{id}/edit', [ReligionController::class,'edit']);
     Route::put('/religion/update/{id}', [ReligionController::class,'update'])->name('religion.update');

     
     Route::any('staff/dashboard', [StaffController::class, 'index'])->name('admin/staff/dashboard');
     Route::any('/changepassword', [DashboardController::class, 'changepassword'])->name('admin.changepassword');
     Route::any('/passwordupdate', [DashboardController::class, 'passwordupdate'])->name('admin.passwordupdate');



   

    Route::any('logout', [LoginController::class, 'destroy'])->name('admin/logout');

});