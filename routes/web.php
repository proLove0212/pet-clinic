<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/login', function () {
    return view('auth.user_login');
});

Route::get('/customer/login', function () {
    return view('temp');
});

Route::get('/admin/login', function () {
    return view('auth.admin_login');
});
Route::post('/logout', 'App\HTTP\Controllers\AuthController@logout');
Route::post('/admin/login', 'App\HTTP\Controllers\AuthController@admin_login')->name('admin_login');
Route::post('/user/login', 'App\HTTP\Controllers\AuthController@user_login')->name('user_login');
Route::post('/customer/login', 'App\HTTP\Controllers\AuthController@customer_login')->name('customer_login');

Route::middleware(['customAuth:admin'])->group(function () {
    Route::get('/admin/users', 'App\HTTP\Controllers\AdminController@all_users');
    Route::get('/admin/users/add', 'App\HTTP\Controllers\AdminController@add_user');
    Route::post('/admin/users/add', 'App\HTTP\Controllers\AdminController@create_user');
    Route::get('/admin/users/edit/{id}', 'App\HTTP\Controllers\AdminController@edit_user');
    Route::post('/admin/users/edit/{id}', 'App\HTTP\Controllers\AdminController@update_user');
    Route::delete('/admin/users/delete/{id}', 'App\HTTP\Controllers\AdminController@delete_user');
    Route::get('/admin/mail', 'App\HTTP\Controllers\AdminController@mail');
    Route::get('/admin/maintain', 'App\HTTP\Controllers\AdminController@maintain');
    Route::post('/admin/maintain', 'App\HTTP\Controllers\AdminController@add_maintain');
    Route::delete('/admin/maintain/delete/{id}', 'App\HTTP\Controllers\AdminController@delete_maintain');
});


Route::middleware(['customAuth:user'])->group(function () {
    Route::get('/dashboard', 'App\HTTP\Controllers\UserController@index');
    Route::get('/upload', 'App\HTTP\Controllers\UserController@getUploadPage');
    Route::get('/reception/settings', 'App\HTTP\Controllers\UserReceptionController@getReceptionSetting');
    Route::get('/reception/reason', 'App\HTTP\Controllers\UserReceptionController@getReceptionReason');
});
