<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\EsquemaController;
use App\Http\Controllers\Admin\DependenciaController;
use App\Http\Controllers\Admin\ProgramaController;
use App\Http\Controllers\Admin\BdiariaController;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\GetlogsController;

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
Route::get('createe', [BdiariaController::class, 'createe'])->name('bdiaria.createe');
Route::post('updateb', [BdiariaController::class, 'updateb'])->name('bdiaria.updateb');

//crud databasesRoute::get('createe', [BdiariaController::class, 'createe'])->name('bdiaria.createe');
//Route::resource('base', BaseController::class);
//Route::get('basehome', [BaseController::class, 'home'])->name('base.home');
Route::get('basebydc/{idd}', [BaseController::class, 'dbbydc'])->name('base.bydc');
Route::get('esquemabydb/{idd}', [EsquemaController::class, 'esquemabydb'])->name('esquema.bydb');

//traer logs

Route::get('getlogs/{logfile}', [GetlogsController::class, 'download'])->name('getlogs.get');