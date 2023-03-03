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


Route::get('/maintain', 'App\HTTP\Controllers\AuthController@notification');

Route::post('/logout', 'App\HTTP\Controllers\AuthController@logout');

Route::post('/admin/login', 'App\HTTP\Controllers\AuthController@admin_login')->name('admin_login');
Route::post('/user/login', 'App\HTTP\Controllers\AuthController@user_login')->name('user_login')->middleware("maintain");
Route::post('/user/request1', 'App\HTTP\Controllers\AuthController@user_request1_handle')->name('user_request1')->middleware("maintain");
Route::post('/user/request2', 'App\HTTP\Controllers\AuthController@user_request2_handle')->name('user_request2')->middleware("maintain");

Route::post('/customer/login', 'App\HTTP\Controllers\AuthController@customer_login')->name('customer_login');

Route::middleware(['customAuth:admin'])->group(function () {
    Route::get('/admin/users', 'App\HTTP\Controllers\AdminController@all_users');
    Route::get('/admin/users/add', 'App\HTTP\Controllers\AdminController@add_user');
    Route::post('/admin/users/add', 'App\HTTP\Controllers\AdminController@create_user');
    Route::get('/admin/users/edit', 'App\HTTP\Controllers\AdminController@edit_user');
    Route::post('/admin/users/edit/{id}', 'App\HTTP\Controllers\AdminController@update_user');
    Route::delete('/admin/users/delete', 'App\HTTP\Controllers\AdminController@delete_user');
    Route::get('/admin/mail', 'App\HTTP\Controllers\AdminController@mail');
    Route::post('/admin/mail/send', 'App\HTTP\Controllers\AdminController@sendMails');
    Route::get('/admin/maintain', 'App\HTTP\Controllers\AdminController@maintain');
    Route::post('/admin/maintain', 'App\HTTP\Controllers\AdminController@add_maintain');
    Route::delete('/admin/maintain/delete/{id}', 'App\HTTP\Controllers\AdminController@delete_maintain');
});


Route::middleware(['customAuth:user', 'maintain'])->group(function () {
    Route::get('/dashboard', 'App\HTTP\Controllers\UserController@index');
    Route::get('/search/name', 'App\HTTP\Controllers\UserController@getSearchNamePage');
    Route::post('/search/name', 'App\HTTP\Controllers\UserController@getSearchNameResult');
    Route::get('/search/phone', 'App\HTTP\Controllers\UserController@getSearchPhonePage');
    Route::post('/search/phone', 'App\HTTP\Controllers\UserController@getSearchPhoneResult');
    Route::get('/upload', 'App\HTTP\Controllers\UserController@getUploadPage');
    Route::post('/upload', 'App\HTTP\Controllers\UserController@uploadCustomerData');

    Route::get('/reception/settings', 'App\HTTP\Controllers\ReceptionSettingController@index');
    Route::post('/reception/settings', 'App\HTTP\Controllers\ReceptionSettingController@update');

    Route::get('/reception/reason', 'App\HTTP\Controllers\ReceptionReasonController@index');
    Route::post('/reception/reason', 'App\HTTP\Controllers\ReceptionReasonController@store');
    Route::post('/reception/reason/order', 'App\HTTP\Controllers\ReceptionReasonController@swap');
    Route::delete('/reception/reason/{id}', 'App\HTTP\Controllers\ReceptionReasonController@delete');

    Route::get('/user/pwd_reset', 'App\HTTP\Controllers\AuthController@getPasswordResetPage');
    Route::post('/user/pwd_reset', 'App\HTTP\Controllers\AuthController@user_pwd_reset');
    Route::get('/customer/view/{c_no}', 'App\HTTP\Controllers\UserController@getCustomerInfo');

});
