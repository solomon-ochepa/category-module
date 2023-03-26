<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\app\Http\Controllers\Admin\CategoryController;

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

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('category', CategoryController::class)->except(['index'])->names('category');
    Route::get('categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category', fn () => redirect(route('admin.category.index')));
});
