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


Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::post('/product/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::post('/product/destroy', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/product/faker', [App\Http\Controllers\ProductController::class, 'faker'])->name('product.faker');
Route::get('/product/getinfo', [App\Http\Controllers\ProductController::class, 'getInfo'])->name('product.getInfo');
Route::post('/product/search', [App\Http\Controllers\ProductController::class, 'search'])->name('product.search');
Route::post('/product/searchby', [App\Http\Controllers\ProductController::class, 'searchBy'])->name('product.searchBy');

Route::post('/user/search', [App\Http\Controllers\UserController::class, 'search'])->name('user.search');

Route::get('/group', [App\Http\Controllers\GroupController::class, 'index'])->name('group.index');
Route::get('/group/all', [App\Http\Controllers\GroupController::class, 'all'])->name('group.all');
Route::post('/group/search', [App\Http\Controllers\GroupController::class, 'search'])->name('group.search');
Route::post('/group/getbytable', [App\Http\Controllers\GroupController::class, 'getByTable'])->name('group.getByTable');
Route::post('/group/getbyid', [App\Http\Controllers\GroupController::class, 'getById'])->name('group.getById');

Route::get('/teste', [App\Http\Controllers\AuthenticateController::class, 'teste']);