<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dbam\HomeController;
use App\Http\Controllers\Dbam\EsquemaController;
use App\Http\Controllers\Dbam\DependenciaController;
use App\Http\Controllers\Dbam\ProgramaController;
use App\Http\Controllers\Dbam\BdiariaController;
use App\Http\Controllers\Dbam\BsemanalController;
use App\Http\Controllers\Dbam\BmanualController;
use App\Http\Controllers\Dbam\BaseController;
use App\Http\Controllers\Dbam\GetlogsController;

Route::get('/', [HomeController::class, 'index']);

//manejo de esquemas
Route::resource('esquema', EsquemaController::class);
Route::get('esquemahome', [EsquemaController::class, 'home'])->name('esquema.home');

//crud programas
Route::resource('programa', ProgramaController::class)->only(['show','index']);

//crud backups diarios
Route::resource('bdiaria', BdiariaController::class);
Route::get('bdiariahome', [BdiariaController::class, 'home'])->name('bdiaria.home');
Route::get('bdiariacreatee', [BdiariaController::class, 'createe'])->name('bdiaria.createe');
Route::post('bdiariaupdateb', [BdiariaController::class, 'updateb'])->name('bdiaria.updateb');

//crud backups semanales
Route::resource('bsemanal', BsemanalController::class);
Route::get('bsemanalhome', [BsemanalController::class, 'home'])->name('bsemanal.home');
Route::get('bsemanalcreatee', [BsemanalController::class, 'createe'])->name('bsemanal.createe');
Route::post('bsemanalupdateb', [BsemanalController::class, 'updateb'])->name('bsemanal.updateb');

//crud backups manuales
Route::resource('bmanual', BmanualController::class);
Route::get('bmanualhome', [BmanualController::class, 'home'])->name('bmanual.home');
Route::get('bmanualcreatee', [BmanualController::class, 'createe'])->name('bmanual.createe');
Route::post('bmanualupdateb', [BmanualController::class, 'updateb'])->name('bmanual.updateb');

//crud databasesRoute::get('createe', [BdiariaController::class, 'createe'])->name('bdiaria.createe');
//Route::resource('base', BaseController::class);
//Route::get('basehome', [BaseController::class, 'home'])->name('base.home');
Route::get('basebydc/{idd}', [BaseController::class, 'dbbydc'])->name('base.bydc');
Route::get('esquemabydb/{idd}', [EsquemaController::class, 'esquemabydb'])->name('esquema.bydb');

//traer logs

Route::get('getlogsd/{logfile}', [GetlogsController::class, 'downloadd'])->name('getlogs.get.d');
Route::get('getlogss/{logfile}', [GetlogsController::class, 'downloads'])->name('getlogs.get.s');
Route::get('getlogsm/{logfile}', [GetlogsController::class, 'downloadm'])->name('getlogs.get.m');
