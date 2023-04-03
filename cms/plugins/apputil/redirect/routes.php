<?php

use Illuminate\Support\Facades\Route;

Route::any('/', function () {
    return Redirect::to(config('backend.uri'));
});
