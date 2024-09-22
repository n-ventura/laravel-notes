<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckIsLogged;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo 'main';
});

//auth routes

Route::get('/login', [AuthController::class, 'login']);
Route::post('/loginSubmit', [AuthController::class, 'loginSubmit']);


//rotas do middleware

Route::middleware([CheckIsLogged::class])->group(function(){
    Route::get('/', [MainController::class, 'index']);
    Route::get('/newNote', [MainController::class, 'newNote']);
    Route::get('/logout', [AuthController::class, 'logout']);
});
