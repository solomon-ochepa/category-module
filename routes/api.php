<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\App\Http\Controllers\CategoryController;

Route::middleware(['auth:api'])->prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class);
});
