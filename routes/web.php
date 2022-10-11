<?php

use Illuminate\Support\Facades\Route;


//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('/archive',\App\Http\Controllers\ArchiveController::class);
