<?php

use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login',[UserController::class,'login']);

Route::post('/register',[UserController::class,'register']);

Route::middleware(['auth:sanctum'])->group(function () {
   
    Route::resource('/movie',MovieController::class);

});