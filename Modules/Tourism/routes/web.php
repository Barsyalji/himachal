<?php

use Illuminate\Support\Facades\Route;
use Modules\Tourism\Http\Controllers\TourismController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('tourisms', TourismController::class)->names('tourism');
});
