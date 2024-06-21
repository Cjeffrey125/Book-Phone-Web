<?php

use Illuminate\Support\Facades\Route;

Route::get('/contacts', function () {
    return view('layout/index');
})->where('any','.*');