<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
use App\Http\Controllers\DanhGiaController;
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
	Route::get('/admin/login', 'LoginController@show_login_form_admin')->name('login-admin');
	Route::post('/login', 'LoginController@process_login')->name('post-login');
	Route::get('/register', 'LoginController@show_signup_form')->name('register')->middleware('can:admin');
	Route::post('/register', 'LoginController@process_signup')->middleware('can:admin');
	Route::post('/logout', 'LoginController@logout')->name('logout');

});



// Auth::routes();
// Route::group(['middleware' => 'auth'], function(){
Route::group(['middleware' => 'auth:user,admin'] ,function(){
	Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('profile', [UserController::class, 'viewProfile'])->name('profile');

    Route::get('/change_password', [UserController::class, 'viewChangePassword'])->name('viewChangePassword');
    Route::post('/change_password', [UserController::class, 'updateChangePassword'])->name('updateChangePassword');


	Route::get('/tieuchuan', [TieuchuanController::class, 'index'])->name('tieuchuan')->middleware('can:admin');
	Route::delete('/tieuchuan/delete', [TieuchuanController::class, 'delete'])->name('delete-tieuchuan')->middleware('can:admin');
	Route::match(['get', 'post'],'/tieuchuan/create', [TieuchuanController::class, 'create'])->name('create-tieuchuan')->middleware('can:admin');
	Route::post('/tieuchuan/update', [TieuchuanController::class, 'update'])->name('update-tieuchuan')->middleware('can:admin');;


	Route::prefix("minh-chung")->name("minhchung.")->group(function(){
		Route::get('/', [MinhChungController::class, 'showCategory'])->name('show-tieu-chuan');
		Route::get('/get-tieuchi/{id}', [MinhChungController::class, 'getTieuChi'])->name('get-tieu-chi');
		Route::get('/tieu-chi-{id}', [MinhChungController::class, 'showListMinhChung'])->name('showListMinhChung');
		Route::get('/minh-chung-{id}', [MinhChungController::class, 'showMinhChung'])->name('showMinhChung');
        Route::get("/them-minh-chung", [MinhChungController::class, "showCreateMinhChung"])->name("show-create")->middleware('can:user');
        Route::post("/them-minh-chung", [MinhChungController::class, "create"])->name("create-minh-chung")->middleware('can:user');
        Route::get("/sua-minh-chung/{id}", [MinhChungController::class, "showEditMinhChung"])->name("show-edit")->middleware('can:user');
        Route::post("/sua-minh-chung", [MinhChungController::class, "edit"])->name("edit-minh-chung")->middleware('can:user');
        Route::post("/cap-nhat-trang-thai", [MinhChungController::class, "updateStatus"])->name("update-status")->middleware('canot:user');
        Route::delete("/xoa-minh-chung", [MinhChungController::class, "delete"])->name("delete-minh-chung")->middleware('can:user');
	});

    Route::prefix("danh-gia")->name("danhgia.")->group(function(){
        Route::get("/", [DanhGiaController::class, "showDanhGia"])->name("tu-danh-gia");
        Route::post('luu-danh-gia', [DanhGiaController::class, "saveDanhGia"])->name('save');
    });


Route::get('/tieuchi', [TieuchiController::class, 'index'])->name('tieuchi')->middleware('can:admin');
Route::delete('/tieuchi/delete', [TieuchiController::class, 'delete'])->name('delete-tieuchi')->middleware('can:admin');
Route::match(['get', 'post'],'/tieuchi/create', [TieuchiController::class, 'create'])->name('create-tieuchi')->middleware('can:admin');
Route::post('/tieuchi/update', [TieuchiController::class, 'update'])->name('update-tieuchi')->middleware('can:admin');



	Route::get('/users-hddg', [UserController::class, 'index_hddg'])->name('users-hddg')->middleware('can:admin');
	Route::get('users-hddg/listing', [UserController::class, 'list_hddg'])->name('hddg.listing')->middleware('can:admin');
	Route::match(['get', 'post'],'/create-hddg', [UserController::class, 'create_hddg'])->name('add-user-hddg')->middleware('can:admin');
	Route::post('edit-hddg', [UserController::class, 'update_hddg'])->name('edit-user-hddg')->middleware('can:admin');
	Route::delete('/delete-hddg', [UserController::class, 'delete_hddg'])->name('delete-user-hddg')->middleware('can:admin');



	Route::get('/users-dvbc', [UserController::class, 'index_dvbc'])->name('users-dvbc')->middleware('can:admin');
	Route::match(['get', 'post'],'/create-dvbc', [UserController::class, 'create_dvbc'])->name('add-user-dvbc')->middleware('can:admin');
	Route::post('edit-dvbc', [UserController::class, 'update_dvbc'])->name('edit-user-dvbc')->middleware('can:admin');
	Route::delete('/delete-dvbc', [UserController::class, 'delete_dvbc'])->name('delete-user-dvbc')->middleware('can:admin');

});

