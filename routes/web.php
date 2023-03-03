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
    Route::get('/admin/users', 'App\HTTP\Controllers\AdminController@index');
    Route::get('/admin/users/add', 'App\HTTP\Controllers\AdminController@create');
    Route::post('/admin/users/add', 'App\HTTP\Controllers\AdminController@store');
    Route::get('/admin/users/edit', 'App\HTTP\Controllers\AdminController@edit');
    Route::post('/admin/users/edit/{id}', 'App\HTTP\Controllers\AdminController@update');
    Route::delete('/admin/users/delete', 'App\HTTP\Controllers\AdminController@delete');

    Route::get('/admin/mail', 'App\HTTP\Controllers\AdminMailController@index');
    Route::post('/admin/mail/send', 'App\HTTP\Controllers\AdminMailController@send');

    Route::get('/admin/maintain', 'App\HTTP\Controllers\MaintainController@index');
    Route::post('/admin/maintain', 'App\HTTP\Controllers\MaintainController@store');
    Route::delete('/admin/maintain/delete/{id}', 'App\HTTP\Controllers\MaintainController@delete');
});


Route::middleware(['customAuth:user', 'maintain'])->group(function () {
    Route::get('/dashboard', 'App\HTTP\Controllers\UserDashboardController@index');

    Route::get('/search/name', 'App\HTTP\Controllers\SearchNameController@index');
    Route::post('/search/name', 'App\HTTP\Controllers\SearchNameController@search');

    Route::get('/search/no', 'App\HTTP\Controllers\SearchNoController@index');
    Route::post('/search/no', 'App\HTTP\Controllers\SearchNoController@search');

    Route::get('/upload', 'App\HTTP\Controllers\UploadController@index');
    Route::post('/upload', 'App\HTTP\Controllers\UploadController@store');

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
