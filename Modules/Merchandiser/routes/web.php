<?php

use Illuminate\Support\Facades\Route;
use Modules\Merchandiser\Http\Controllers\MerchandiserController;

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
    Route::resource('merchandiser', MerchandiserController::class)->names('merchandiser');
    
});

Route::prefix('admin/merchandiser')->middleware('auth:admin')->group(function () {
   
    Route::any('/merchandisermodel', [MerchandiserController::class, 'index'])->name('merchandiser.merchandisermodel');
    Route::post('/save', MerchandiserController::class,'store')->names('merchandiser.save');
    Route::any('/merchandisermodel/{id}/edit', [MerchandiserController::class,'edit']);
    Route::any('/merchandisermodel/create', MerchandiserController::class,'create')->names('merchandisermodel/create');
    Route::put('/update', [MerchandiserController::class,'update'])->name('merchandiser.update');
    Route::any('/show', [MerchandiserController::class,'show'])->name('merchandisermodel/show');
    Route::any('/merchandisermodel/{id}/destroy', [MerchandiserController::class,'destroy']);
    Route::any('/merchandisermodel/{id}/updatestatus', [MerchandiserController::class,'updatestatus']);
});