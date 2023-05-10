<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
<<<<<<< Updated upstream
});

Route::get('/password/reset', function () {
    return view('auth.passwords.email');
});
=======
});*/

Route::get('/home', function () {
    return view('home');
});

// Route::get('password/reset', function () {
//     return view('auth.passwords.email');
// });
>>>>>>> Stashed changes

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
<<<<<<< Updated upstream
=======
*/
>>>>>>> Stashed changes
