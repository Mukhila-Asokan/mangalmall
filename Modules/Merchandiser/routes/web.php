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

/*Route::group([], function () {
    Route::resource('merchandiser', MerchandiserController::class)->names('merchandiser');
});*/


Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::any('/merchandisercategory', [MerchandiserController::class,'index'])->name('admin/merchandisercategory');
});