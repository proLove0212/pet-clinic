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
    return view('temp');
});

Route::get('/customer/login', function () {
    return view('temp');
});

Route::get('/admin/login', function () {
    return view('auth.admin_login');
});

Route::post('/admin/login', 'App\HTTP\Controllers\AuthController@admin_login')->name('admin_login');
Route::post('/user/login', 'App\HTTP\Controllers\AuthController@user_login')->name('user_login');
Route::post('/customer/login', 'App\HTTP\Controllers\AuthController@customer_login')->name('customer_login');

// Route::middleware([EnsureTokenIsValid::class])->group(function () {

// });

