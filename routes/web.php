<?php

use Illuminate\Support\Facades\Route;


//Route::get('/', function () {
//    return view('welcome');
//});

Route::resource('/archive',\App\Http\Controllers\ArchiveController::class);
Route::post('/archive/media',[\App\Http\Controllers\ArchiveController::class,'storeMedia'])->name('archive.storeMedia');
Route::get('/about',[\App\Http\Controllers\AboutController::class,'index'])->name('about');
