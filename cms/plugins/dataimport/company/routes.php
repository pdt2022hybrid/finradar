<?php

use Illuminate\Support\Facades\Route;
use DataImport\Company\Classes\ApiService;

Route::get('/api/testh', [ApiService::class, 'hardRefresh']);
Route::get('/api/testg', [ApiService::class, 'gracefulRefresh']);
