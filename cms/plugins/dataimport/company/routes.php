<?php

use Illuminate\Support\Facades\Route;
use DataImport\Company\Classes\ApiService as CompanyApiService;

Route::group(['prefix' => 'api/import'], function () {
    Route::group(['prefix' => 'company'], function () {
        Route::get('/hard', [CompanyApiService::class, 'hardRefresh']);
        Route::get('/graceful', [CompanyApiService::class, 'gracefulRefresh']);
        Route::get('/specific/{ico}', [CompanyApiService::class, 'specificRefresh']);
    });
});
