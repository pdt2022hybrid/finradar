<?php

use Dataimport\Importer\classes\Import;
use Dataimport\Report\classes\ApiTemplate;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/import'], function () {
        Route::get('/load', [Import::class, 'hardRefresh']);
        Route::get('/refresh', [Import::class, 'gracefulRefresh']);
        Route::get('/ico/{ico}', [Import::class, 'specificRefresh']);
});

// FIXME: remove this
