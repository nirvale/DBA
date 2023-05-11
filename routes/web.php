<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrivateController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/home', function () {
    return view('home');
});

Route::get('/cerrars', [PrivateController::class, 'cerrars'])->name('cerrars');
Route::post('/cerrarsp', [PrivateController::class, 'cerrarsp'])->name('cerrarsp');
// Route::get('password/reset', function () {
//     return view('auth.passwords.email');
// });
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });
