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
    return view('home');
});


Route::post('/authenticate', [App\Http\Controllers\AuthenticateController::class, 'login'])->name('authenticate.login');
Route::get('/authenticate/logout', [App\Http\Controllers\AuthenticateController::class, 'logout'])->name('authenticate.logout');
//Route::get('/authenticate', [App\Http\Controllers\AuthenticateController::class, 'login'])->name('authenticate.login');


Route::get('/teste', [App\Http\Controllers\AuthenticateController::class, 'teste']);