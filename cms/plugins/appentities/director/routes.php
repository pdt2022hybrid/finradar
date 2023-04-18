<?php

use Illuminate\Support\Facades\Route;
use AppEntities\Director\Http\Controllers\DirectorController;
use AppEntities\Director\Http\Controllers\DirectorSearchController;

Route::group(['prefix' => 'api/v1'], function() {

    Route::get('directors/search', [DirectorSearchController::class, 'search']);

    Route::apiResource('directors', DirectorController::class)->only(['show']);

});
