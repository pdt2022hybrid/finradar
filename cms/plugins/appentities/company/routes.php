<?php

use Illuminate\Support\Facades\Route;
use AppEntities\Company\Http\Controllers\CompanyController;
use AppEntities\Company\Http\Controllers\SearchController;

Route::group(['prefix' => 'api'], function() {

    Route::get('companies/search', [SearchController::class, 'search']);

    Route::apiResource('companies', CompanyController::class)->only(['index', 'show']);

});
