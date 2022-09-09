<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;

Route::get('', [HomeController::class, 'index']);
//manejo de usuarios
Route::resource('usuario', UserController::class);
