<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MinhchungcsgdController;
use App\Http\Controllers\MinhChungController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TieuchuanController;
use App\Http\Controllers\TieuchiController;
// use App\Http\Controllers\TieuchuancsgdController;
// use App\Http\Controllers\BaocaocsgdController;
use App\Http\Controllers\EmpController;
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
});

Route::namespace('App\Http\Controllers\Auth')->group(function () {
	Route::get('/login', 'LoginController@show_login_form')->name('login');
	Route::post('/login', 'LoginController@process_login')->name('post-login');
	Route::get('/register', 'LoginController@show_signup_form')->name('register')->middleware('can:admin');
	Route::post('/register', 'LoginController@process_signup')->middleware('can:admin');
	Route::get('/logout', 'LoginController@logout')->name('logout');

});

// Auth::routes();
// Route::group(['middleware' => 'auth'], function(){
Route::group([] ,function(){
	Route::get('/home', [HomeController::class, 'index'])->name('home');

	Route::get('employee', [EmpController::class, 'index']);
	Route::get('emp/listing', [EmpController::class, 'getEmployees'])->name('emp.listing');

// 	Route::get('/home', 'HomeController@index')->name('home');

// 	Route::get('/nhomthuchien', 'HomeController@show')->name('nhomthuchien');
	// Route::get('/tieuchuan', 'TieuchuanController@index')->name('tieuchuan');
 	// Route::match(['get', 'post'],'/themtieuchuan', 'TieuchuanController@add')->name('themtieuchuan');

	Route::get('/tieuchuan', [TieuchuanController::class, 'index'])->name('tieuchuan');
	Route::delete('/tieuchuan/delete', [TieuchuanController::class, 'delete'])->name('delete-tieuchuan');
	Route::match(['get', 'post'],'/tieuchuan/create', [TieuchuanController::class, 'create'])->name('create-tieuchuan');
	Route::post('/tieuchuan/update', [TieuchuanController::class, 'update'])->name('update-tieuchuan');
	// Route::match(['get', 'post'],'/timtieuchuancsgd', 'TieuchuancsgdController@search')->name('timtieuchuancsgd');
	// Route::match(['get', 'post'],'/themtieuchuancsgd', 'TieuchuancsgdController@add')->name('themtieuchuancsgd');


	// Route::get('/tieuchuancsgd', [TieuchuancsgdController::class, 'index'])->name('tieuchuancsgd');
	// Route::match(['get', 'post'],'/timtieuchuancsgd', 'TieuchuancsgdController@search')->name('timtieuchuancsgd');
	// Route::match(['get', 'post'],'/themtieuchuancsgd', 'TieuchuancsgdController@add')->name('themtieuchuancsgd');


// 	Route::get('/tieuchuanctdt', 'TieuchuanctdtController@index')->name('tieuchuanctdt');
// 	Route::match(['get', 'post'],'/timtieuchuanctdt', 'TieuchuanctdtController@search')->name('timtieuchuanctdt');
// /*	Route::match(['get', 'post'],'/themtieuchuanctdt', 'TieuchuanctdtController@add')->name('themtieuchuanctdt');
// */

	Route::get('/minhchungcsgd', [MinhchungcsgdController::class, 'index'])->name('minhchungcsgd')->middleware('can:admin');
	Route::match(['get', 'post'],'/themminhchungcsgd', [MinhchungcsgdController::class, 'create'])->name('themminhchungcsgd');
	Route::match(['get', 'post'],'/suaminhchungcsgd/{id}', [MinhchungcsgdController::class, 'edit'])->name('suaminhchungcsgd');
	Route::get('/xoaminhchungcsgd/{id}', [MinhchungcsgdController::class, 'delete'])->middleware('can:admin');;
	Route::match(['get', 'post'],'/timminhchungcsgd', [MinhchungcsgdController::class, 'search'])->name('timminhchungcsgd');

	Route::prefix("minh-chung")->name("minhchung.")->group(function(){
		Route::get('/', [MinhChungController::class, 'showCategory'])->name('show-tieu-chuan');
		Route::get('/get-tieuchi/{id}', [MinhChungController::class, 'getTieuChi'])->name('get-tieu-chi');
		Route::get('/tieu-chi-{id}', [MinhChungController::class, 'showListMinhChung'])->name('showListMinhChung');
		Route::get('/minh-chung-{id}', [MinhChungController::class, 'showMinhChung'])->name('showMinhChung');
	});


// 	Route::get('/minhchungctdt', 'MinhchungctdtController@index')->name('minhchungctdt');
// 	Route::match(['get', 'post'],'/themminhchungctdt', 'MinhchungctdtController@create')->name('themminhchungctdt');
// 	Route::match(['get', 'post'],'/suaminhchungctdt/{id}', 'MinhchungctdtController@edit')->name('suaminhchungctdt');
// 	Route::get('/xoaminhchungctdt/{id}', 'MinhchungctdtController@delete');
// 	Route::match(['get', 'post'],'/timminhchungctdt', 'MinhchungctdtController@search')->name('timminhchungctdt');

Route::get('/tieuchi', [TieuchiController::class, 'index'])->name('tieuchi');
Route::delete('/tieuchi/delete', [TieuchiController::class, 'delete'])->name('delete-tieuchi');
Route::match(['get', 'post'],'/tieuchi/create', [TieuchiController::class, 'create'])->name('create-tieuchi');
Route::post('/tieuchi/update', [TieuchiController::class, 'update'])->name('update-tieuchi');


// 	Route::get('/tieuchi', 'TieuchiController@index')->name('tieuchi');
// /*	Route::match(['get', 'post'],'/themtieuchi', 'TieuchiController@create')->name('themtieuchi');
// */
// 	Route::match(['get', 'post'],'/danhgiatieuchi', 'TieuchiController@danhgia')->name('danhgiatieuchi');

// 	Route::get('/tieuchicsgd', 'TieuchicsgdController@index')->name('tieuchicsgd');
// 	Route::match(['get', 'post'],'/timtieuchicsgd', 'TieuchicsgdController@search')->name('timtieuchicsgd');

// 	Route::get('/tieuchictdt', 'TieuchictdtController@index')->name('tieuchictdt');
// 	Route::match(['get', 'post'],'/timtieuchictdt', 'TieuchictdtController@search')->name('timtieuchictdt');

	// Route::get('/danhsachbaocaocsgd', [BaocaocsgdController::class, 'index'])->name('danhsachbaocaocsgd');
	// Route::match(['get', 'post'],'/vietbaocaocsgd', [BaocaocsgdController::class, 'create'])->name('vietbaocaocsgd');
	// Route::match(['get', 'post'],'/suabaocaocsgd/{id}', 'BaocaocsgdController@edit')->name('suabaocaocsgd');
	// Route::get('/xoabaocaocsgd/{id}', 'BaocaocsgdController@delete');
	// Route::match(['get', 'post'],'/timbaocaocsgd', 'BaocaocsgdController@search')->name('timbaocaocsgd');

	// Route::match(['get', 'post'],'/chonminhchungcsgd', 'MinhchungcsgdController@show')->name('chonminhchungcsgd');
	// Route::match(['get', 'post'],'/chontieuchuancsgd', 'TieuchuancsgdController@show')->name('chontieuchuancsgd');
// 	Route::match(['get', 'post'],'/chontieuchicsgd', 'TieuchicsgdController@show')->name('chonchicsgd');


// 	Route::get('/danhsachbaocaoctdt', 'BaocaoctdtController@index')->name('danhsachbaocaoctdt');
// 	Route::match(['get', 'post'],'/vietbaocaoctdt', 'BaocaoctdtController@create')->name('vietbaocaoctdt');
// 	Route::match(['get', 'post'],'/suabaocaoctdt/{id}', 'BaocaoctdtController@edit')->name('suabaocaoctdt');
// 	Route::get('/xoabaocaoctdt/{id}', 'BaocaoctdtController@delete');
// 	Route::match(['get', 'post'],'/timbaocaoctdt', 'BaocaoctdtController@search')->name('timbaocaoctdt');

// 	Route::match(['get', 'post'],'/chonminhchungctdt', 'MinhchungctdtController@show')->name('chonminhchungctdt');
// 	Route::match(['get', 'post'],'/chontieuchuanctdt', 'TieuchuanctdtController@show')->name('chontieuchuanctdt');
// 	Route::match(['get', 'post'],'/chontieuchictdt', 'TieuchictdtController@show')->name('chontieuchictdt');

	Route::get('/users-hddg', [UserController::class, 'index_hddg'])->name('users-hddg')->middleware('can:admin');
	Route::get('users-hddg/listing', [UserController::class, 'list_hddg'])->name('hddg.listing');
	Route::match(['get', 'post'],'/create-hddg', [UserController::class, 'create_hddg'])->name('add-user-hddg')->middleware('can:admin');
	Route::post('edit-hddg', [UserController::class, 'update_hddg'])->name('edit-user-hddg')->middleware('can:admin');
	Route::delete('/delete-hddg', [UserController::class, 'delete_hddg'])->name('delete-user-hddg')->middleware('can:admin');



	Route::get('/users-dvbc', [UserController::class, 'index_dvbc'])->name('users-dvbc')->middleware('can:admin');
	Route::match(['get', 'post'],'/create-dvbc', [UserController::class, 'create_dvbc'])->name('create-dvbc')->middleware('can:admin');
	Route::get('/delete-dvbc/{id}', [UserController::class, 'delete_dvbc'])->middleware('can:admin');
	
// 	Route::match(['get', 'post'],'/suauser/{id}', 'UserController@edit')->name('suauser');
// 	Route::match(['get', 'post'],'/timuser', 'UserController@search')->name('timuser');


});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
