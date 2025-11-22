<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\App\Http\Controllers\CategoryController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('categories', CategoryController::class);
});
