<?php

use Illuminate\Support\Facades\Route;
use Modules\Tourism\Http\Controllers\TourismController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('tourisms', TourismController::class)->names('tourism');
});
