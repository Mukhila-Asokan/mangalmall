<?php

use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;


use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return view('admin/auth/login');
});

Route::prefix('admin')->middleware('guest:admin')->group(function () {

 

    Route::get('login', [LoginController::class, 'create'])->name('admin.login');
   Route::post('authcheck', [LoginController::class, 'authcheck'])->name('admin.authcheck');

});

Route::get('/adminrole', [RoleController::class, 'redirectRoutes'])->name('adminrole');

Route::prefix('admin')->middleware('auth:admin')->group(function () {

 /*   Route::get('/dashboard', function () {
        return view('admin/dashboard');
    })->name('admin.dashboard');*/


     Route::any('/dashboard', [DashboardController::class, 'index'])->name('admin/dashboard');
     Route::any('staff/dashboard', [StaffController::class, 'index'])->name('admin/staff/dashboard');
     Route::any('/changepassword', [DashboardController::class, 'changepassword'])->name('admin.changepassword');
     Route::any('/passwordupdate', [DashboardController::class, 'passwordupdate'])->name('admin.passwordupdate');

    Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');

});