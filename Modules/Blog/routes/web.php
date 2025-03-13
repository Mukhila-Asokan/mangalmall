<?php

use Illuminate\Support\Facades\Route;
use Modules\Blog\Http\Controllers\BlogController;
use Modules\Blog\Http\Controllers\BlogCategoryController;
use Modules\Blog\Http\Controllers\BlogTagController;

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

Route::prefix('admin')->middleware('admin.role','auth:admin')->group(function () {   

    Route::any('/blog', [BlogController::class,'index'])->name('admin.blog');

    Route::any('/blog/category', [BlogCategoryController::class,'index'])->name('admin.blogcategory');
    Route::any('/blog/category/create', [BlogCategoryController::class,'create'])->name('blogcategory.create');
    Route::post('/blog/categorystore', [BlogCategoryController::class,'store'])->name('blogcategory.add');    
    Route::any('/blog/category/{id}/edit', [BlogCategoryController::class,'edit']);
    Route::put('/blog/category/update/{id}', [BlogCategoryController::class,'update'])->name('blogcategory.update');
    Route::any('/blog/category/{id}/destroy', [BlogCategoryController::class,'destroy']);
    Route::any('/blog/category/{id}/updatestatus', [BlogCategoryController::class,'updatestatus']);

    Route::any('/blog/tags', [BlogTagController::class,'index'])->name('admin.blogtag');
    Route::any('/blog/tags/create', [BlogTagController::class,'create'])->name('blogtag.create');
    Route::post('/blog/tagsstore', [BlogTagController::class,'store'])->name('blogtag.add');   
    Route::any('/blog/tags/{id}/edit', [BlogTagController::class,'edit']);
    Route::put('/blog/tags/update/{id}', [BlogTagController::class,'update'])->name('blogtag.update');
    Route::any('/blog/tags/{id}/destroy', [BlogTagController::class,'destroy']);
    Route::any('/blog/tags/{id}/updatestatus', [BlogTagController::class,'updatestatus']);

});