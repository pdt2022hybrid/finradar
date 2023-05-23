<?php

use Illuminate\Support\Facades\Route;
use AppEntities\Company\Http\Controllers\CompanyController;
use AppEntities\Company\Http\Controllers\SearchController;
use WApi\ApiException\Http\Middlewares\ApiExceptionMiddleware;

Route::group(['middleware' => [ApiExceptionMiddleware::class],'prefix' => 'api/v1'], function() {

    Route::get('companies/search', [SearchController::class, 'search']);

    Route::apiResource('companies', CompanyController::class)->only(['index', 'show']);

});
