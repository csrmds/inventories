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
})->name('/');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/laravel', function () {
    return view('welcome');
});

Route::get('/phpinfo', function() {
    return phpinfo();
});

// Route::get('login', function() {
//     return view('home');
// })->name('login');

Route::post('/authenticate', [App\Http\Controllers\AuthenticateController::class, 'login'])->name('authenticate.login');
Route::match(['get','post'], '/authenticate/logout', [App\Http\Controllers\AuthenticateController::class, 'logout'])->name('authenticate.logout');
Route::get('/authenticate/teste', [App\Http\Controllers\AuthenticateController::class, 'teste'])->name('authenticate.teste');

Route::get('/people', [App\Http\Controllers\PeopleController::class, 'index'])->name('people.index');
Route::get('/people/create', [App\Http\Controllers\PeopleController::class, 'create'])->name('people.create');
Route::get('/people/edit', [App\Http\Controllers\PeopleController::class, 'edit'])->name('people.edit');
Route::post('/people/save', [App\Http\Controllers\PeopleController::class, 'save'])->name('people.save');
Route::post('/people/update', [App\Http\Controllers\PeopleController::class, 'update'])->name('people.update');
Route::post('/people/destroy', [App\Http\Controllers\PeopleController::class, 'destroy'])->name('people.destroy');
Route::get('/people/faker', [App\Http\Controllers\PeopleController::class, 'faker'])->name('people.faker');
Route::post('/people/search', [App\Http\Controllers\PeopleController::class, 'search'])->name('people.search');
Route::post('/people/searchby', [App\Http\Controllers\PeopleController::class, 'searchby'])->name('people.searchby');
Route::post('/people/getbyid', [App\Http\Controllers\PeopleController::class, 'getbyid'])->name('people.getbyid');
Route::post('/people/listcategory', [App\Http\Controllers\PeopleController::class, 'listcategory'])->name('people.listcategory');
Route::post('/people/getuser', [App\Http\Controllers\PeopleController::class, 'getUser'])->name('people.getUser');
Route::post('/people/removeldapuser', [App\Http\Controllers\PeopleController::class, 'removeLdapUser'])->name('people.removeLdapUser');

Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
Route::match(['get','post'], '/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
Route::post('/product/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/save', [App\Http\Controllers\ProductController::class, 'save'])->name('product.save');
Route::post('/product/update', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
Route::post('/product/destroy', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/product/faker', [App\Http\Controllers\ProductController::class, 'faker'])->name('product.faker');
Route::get('/product/getinfo', [App\Http\Controllers\ProductController::class, 'getInfo'])->name('product.getInfo');
Route::post('/product/search', [App\Http\Controllers\ProductController::class, 'search'])->name('product.search');
Route::post('/product/searchby', [App\Http\Controllers\ProductController::class, 'searchBy'])->name('product.searchBy');
Route::post('/product/getbyid', [App\Http\Controllers\ProductController::class, 'getbyid'])->name('product.getbyid');
Route::post('/product/getgroups', [App\Http\Controllers\ProductController::class, 'getgroups'])->name('product.getgroups');
Route::get('/product/teste', [App\Http\Controllers\ProductController::class, 'teste'])->name('product.teste');


Route::post('/user/search', [App\Http\Controllers\UserController::class, 'search'])->name('user.search');
//Route::post('/user/getldapuser', [App\Http\Controllers\UserController::class, 'getLdapUser'])->name('user.getLdapUser');

Route::get('/group', [App\Http\Controllers\GroupController::class, 'index'])->name('group.index');
Route::get('/group/all', [App\Http\Controllers\GroupController::class, 'all'])->name('group.all');
Route::post('/group/search', [App\Http\Controllers\GroupController::class, 'search'])->name('group.search');
Route::post('/group/getbytable', [App\Http\Controllers\GroupController::class, 'getByTable'])->name('group.getByTable');
Route::post('/group/getbyid', [App\Http\Controllers\GroupController::class, 'getById'])->name('group.getById');

Route::get('/location', [App\Http\Controllers\LocationController::class, 'index'])->name('location');
Route::post('/location/save', [App\Http\Controllers\LocationController::class, 'save'])->name('location.save');
Route::post('/location/update', [App\Http\Controllers\LocationController::class, 'update'])->name('location.update');
Route::post('/location/destroy', [App\Http\Controllers\LocationController::class, 'destroy'])->name('location.destroy');
Route::post('/location/search', [App\Http\Controllers\LocationController::class, 'search'])->name('location.search');
Route::post('/location/getbyid', [App\Http\Controllers\LocationController::class, 'getbyid'])->name('location.getbyid');


Route::post('/ocs/search', [App\Http\Controllers\OcsHardwareController::class, 'search'])->name('ocs.search');
Route::post('/ocs/searchbyid/{id?}', [App\Http\Controllers\OcsHardwareController::class, 'searchById'])->name('ocs.searchById');
//Route::get('/ocs/tag', [App\Http\Controllers\OcsHardwareController::class, 'tag'])->name('ocs.tag');

Route::get('/csv', [App\Http\Controllers\CsvController::class, 'index'])->name('csv');
Route::post('/csv/import/products', [App\Http\Controllers\CsvController::class, 'importProducts'])->name('csv.import.products');
Route::post('/csv/import/people', [App\Http\Controllers\CsvController::class, 'importPeople'])->name('csv.import.people');

Route::post('/ldap/searchgroup', [App\Http\Controllers\LdapController::class, 'searchGroup'])->name('ldap.searchGroup');
//Route::post('/ldap/searchuser', [App\Http\Controllers\LdapController::class, 'searchUser'])->name('ldap.searchUser');
// Route::post('/ldap/teste', [App\Http\Controllers\LdapController::class, 'teste'])->name('ldap.teste');

Route::prefix('/ldap')->name('ldap.')->group(function() {
    Route::get('/', [App\Http\Controllers\LdapUserController::class, 'home'])->name('home');
    Route::match(['get', 'post'], '/home', [App\Http\Controllers\LdapUserController::class, 'home'])->name('home');
    Route::post('/login', [App\Http\Controllers\LdapUserController::class, 'login'])->name('login');
    Route::match(['get', 'post'], '/logout', [App\Http\Controllers\LdapUserController::class, 'logout'])->name('logout');
    Route::post('/checkCred', [App\Http\Controllers\LdapUserController::class, 'checkCred'])->name('checkCred');
    Route::post('/getldapuser', [App\Http\Controllers\LdapUserController::class, 'getLdapUser'])->name('getLdapUser');
    Route::post('/searchuser', [App\Http\Controllers\LdapUserController::class, 'searchUser'])->name('searchUser');
    Route::get('/teste', [App\Http\Controllers\LdapUserController::class, 'teste'])->name('teste');
});

Route::prefix('/order')->name('order.')->group(function() {
    Route::get('/', [App\Http\Controllers\OrderController::class, 'index'])->name('home');
    Route::post('/search', [App\Http\Controllers\OrderController::class, 'search'])->name('search');
    Route::post('/getById', [App\Http\Controllers\OrderController::class, 'getById'])->name('getById');
    Route::post('/save', [App\Http\Controllers\OrderController::class, 'save'])->name('save');
    Route::post('/update', [App\Http\Controllers\OrderController::class, 'update'])->name('update');
    
    Route::get('/item', [App\Http\Controllers\OrderItemController::class, 'index'])->name('itemhome');
    Route::post('/itembyorder', [App\Http\Controllers\OrderItemController::class, 'getByOrder'])->name('itembyorder');
    Route::post('/itemsave', [App\Http\Controllers\OrderItemController::class, 'save'])->name('itemsave');
    Route::post('/itemdestroy', [App\Http\Controllers\OrderItemController::class, 'destroy'])->name('itemdestroy');
    Route::post('/itemsearch', [App\Http\Controllers\OrderItemController::class, 'search'])->name('itemsearch');
});

Route::get('/movement/savebyorder', [App\Http\Controllers\MovementController::class, 'saveByOrder'])->name('movement.saveByOrder');

Route::post('/servers/ocscreatetables', [App\Http\Controllers\ServersController::class, 'ocsCreateTables'])->name('servers.ocsCreateTables');
Route::get('/servers', [App\Http\Controllers\ServersController::class, 'index'])->name('servers.index');


Route::get('/teste', function() {
    return view('teste');
})->name('teste');

// Route::match(['get', 'post'], '/teste/teste', [App\Http\Controllers\TesteController::class, 'teste'])->name('teste.teste');
// Route::match(['get', 'post'], '/teste/createuser', [App\Http\Controllers\TesteController::class, 'createUser'])->name('teste.createUser');
// Route::match(['get', 'post'], '/teste/ldaplogin', [App\Http\Controllers\TesteController::class, 'ldapLogin'])->name('teste.ldapLogin');
// Route::match(['get', 'post'], '/teste/dblogin', [App\Http\Controllers\TesteController::class, 'dbLogin'])->name('teste.dbLogin');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
