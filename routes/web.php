<?php

use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::prefix('/register')->name('register.')->group(function () {
    Route::get('/', [RegisterController::class, 'index'])->name("index");
//    Route::post('/', [RegisterController::class, 'create'])->name("create");
});
