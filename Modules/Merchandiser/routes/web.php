<?php

use Illuminate\Support\Facades\Route;
use Modules\Merchandiser\Http\Controllers\MerchandiserController;
use Modules\Merchandiser\Http\Controllers\MerchandiserCategoryController;

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

/* Route::group([], function () {
    Route::resource('merchandiser', MerchandiserController::class)->names('merchandiser');
}); */


Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::any('/merchandisercategory', [MerchandiserCategoryController::class, 'index'])->name('merchandisercategory');
    Route::post('/merchandisercategory/save', [MerchandiserCategoryController::class, 'store'])->name('merchandisercategory.save');
    Route::any('/merchandisercategory/{id}/edit', [MerchandiserCategoryController::class, 'edit']);
    Route::any('/merchandisercategory/create', [MerchandiserCategoryController::class, 'create'])->name('merchandisercategory.create');
    Route::put('/merchandisercategory/update/{id}', [MerchandiserCategoryController::class, 'update'])->name('merchandisercategory.update');
    Route::any('/merchandisercategory/show', [MerchandiserCategoryController::class, 'show'])->name('merchandisercategory.show');
    Route::any('/merchandisercategory/{id}/destroy', [MerchandiserCategoryController::class, 'destroy']);
    Route::any('/merchandisercategory/{id}/updatestatus', [MerchandiserCategoryController::class, 'updatestatus']); 
});
