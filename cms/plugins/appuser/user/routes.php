<?php

use Illuminate\Support\Facades\Route;
use Appuser\User\Http\Controllers\DashboardController;

Route::group(['prefix' => 'api/v1'], function() {

    Route::get('dashboards', [DashboardController::class, 'index']);
    Route::patch('dashboards/addCompany', [DashboardController::class, 'addCompany']);
    Route::patch('dashboards/removeCompany', [DashboardController::class, 'removeCompany']);

});

