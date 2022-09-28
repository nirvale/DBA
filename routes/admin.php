<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\EsquemaController;
use App\Http\Controllers\Admin\DependenciaController;
use App\Http\Controllers\Admin\ProgramaController;

Route::get('', [HomeController::class, 'index']);
//manejo de usuarios
Route::resource('usuario', UserController::class)->except(['edit']);
Route::get('listausuarios', [UserController::class, 'listausuarios'])->name('usuario.lista');

//manejo de esquemas
Route::resource('esquema', EsquemaController::class);
Route::get('esquemahome', [EsquemaController::class, 'home'])->name('esquema.home');

//crud programas
Route::resource('programa', ProgramaController::class)->only(['show','index']);
