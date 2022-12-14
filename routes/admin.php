<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\EsquemaController;
use App\Http\Controllers\Admin\DependenciaController;
use App\Http\Controllers\Admin\ProgramaController;
use App\Http\Controllers\Admin\BdiariaController;
use App\Http\Controllers\Admin\BaseController;

Route::get('', [HomeController::class, 'index']);
//manejo de usuarios
Route::resource('usuario', UserController::class)->except(['edit']);
Route::get('listausuarios', [UserController::class, 'listausuarios'])->name('usuario.lista');

//manejo de esquemas
Route::resource('esquema', EsquemaController::class);
Route::get('esquemahome', [EsquemaController::class, 'home'])->name('esquema.home');

//crud programas
Route::resource('programa', ProgramaController::class)->only(['show','index']);

//crud backups
Route::resource('bdiaria', BdiariaController::class);
Route::get('bdiariahome', [BdiariaController::class, 'home'])->name('bdiaria.home');

//crud databases
//Route::resource('base', BaseController::class);
//Route::get('basehome', [BaseController::class, 'home'])->name('base.home');
Route::get('basebydc/{idd}', [BaseController::class, 'dbbydc'])->name('base.bydc');
