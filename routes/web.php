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
    return redirect('/petcrew');
});

Route::get('/petcrew', function () {
    return view('welcome');
});

Route::get('/petcrew/login', function () {
    return view('auth.user.login');
});

Route::get('/petcrew/admin/login', function () {
    return view('auth.admin.login');
});


Route::get('/petcrew/maintain', 'App\HTTP\Controllers\AuthController@notification');

Route::post('/logout', 'App\HTTP\Controllers\AuthController@logout');

Route::post('/petcrew/admin/login', 'App\HTTP\Controllers\AuthController@admin_login')->name('admin_login');

Route::middleware(['maintain'])->group(function () {
    Route::post('/petcrew/login', 'App\HTTP\Controllers\AuthController@user_login')->name('user_login');

    Route::get('/petcrew/account/password/reset_1', 'App\HTTP\Controllers\UserForgotController@index_pwd');
    Route::post('/petcrew/account/password/reset_1', 'App\HTTP\Controllers\UserForgotController@reset_pwd');
    Route::get('/petcrew/account/password/reset_2', 'App\HTTP\Controllers\UserForgotController@index_all');
    Route::post('/petcrew/account/password/reset_2', 'App\HTTP\Controllers\UserForgotController@reset_all');

});

Route::middleware(['customAuth:admin'])->group(function () {
    Route::get('/petcrew/admin', 'App\HTTP\Controllers\AdminController@index');

    Route::get('/petcrew/admin/users/add', 'App\HTTP\Controllers\AdminController@create');
    Route::post('/petcrew/admin/users/add', 'App\HTTP\Controllers\AdminController@store');

    Route::get('/petcrew/admin/users/edit/{id}', 'App\HTTP\Controllers\AdminController@edit');
    Route::post('/petcrew/admin/users/edit/{id}', 'App\HTTP\Controllers\AdminController@update');

    Route::post('/petcrew/admin/users/pwd_reset/{cid}', 'App\HTTP\Controllers\AdminController@pwd_reset');
    Route::delete('/petcrew/admin/users/delete/{cid}', 'App\HTTP\Controllers\AdminController@delete');

    Route::get('/petcrew/admin/contact', 'App\HTTP\Controllers\AdminMailController@index');
    Route::post('/petcrew/admin/contact/send', 'App\HTTP\Controllers\AdminMailController@send');

    Route::get('/petcrew/admin/maintain', 'App\HTTP\Controllers\MaintainController@index');
    Route::post('/petcrew/admin/maintain', 'App\HTTP\Controllers\MaintainController@store');
    Route::delete('/petcrew/admin/maintain/delete/{id}', 'App\HTTP\Controllers\MaintainController@delete');

    Route::get('/petcrew/admin/account', 'App\HTTP\Controllers\AccountController@get_admin_change');
    Route::post('/petcrew/admin/account/pwd', 'App\HTTP\Controllers\AccountController@admin_pwd_change');
    Route::post('/petcrew/admin/account/email', 'App\HTTP\Controllers\AccountController@admin_email_change');
});


Route::middleware(['customAuth:user', 'maintain'])->group(function () {
    Route::get('/petcrew/search', 'App\HTTP\Controllers\UserDashboardController@index');

    Route::get('/petcrew/search', 'App\HTTP\Controllers\SearchController@index');
    Route::post('/petcrew/search', 'App\HTTP\Controllers\SearchController@search');

    Route::get('/petcrew/upload', 'App\HTTP\Controllers\UploadController@index');
    Route::post('/petcrew/upload', 'App\HTTP\Controllers\UploadController@store');

    // Route::get('/reception/settings', 'App\HTTP\Controllers\ReceptionSettingController@index');
    // Route::post('/reception/settings', 'App\HTTP\Controllers\ReceptionSettingController@update');

    // Route::get('/reception/reason', 'App\HTTP\Controllers\ReceptionReasonController@index');
    // Route::post('/reception/reason', 'App\HTTP\Controllers\ReceptionReasonController@store');
    // Route::post('/reception/reason/order', 'App\HTTP\Controllers\ReceptionReasonController@swap');
    // Route::delete('/reception/reason/{id}', 'App\HTTP\Controllers\ReceptionReasonController@delete');

    Route::get('/petcrew/account/pwd_reset', 'App\HTTP\Controllers\AuthController@getPasswordResetPage');
    Route::post('/petcrew/account/pwd_reset', 'App\HTTP\Controllers\AuthController@user_pwd_reset');
    Route::get('/petcrew/customer/info/{id}', 'App\HTTP\Controllers\SearchController@getCustomerInfo');

    Route::get('/petcrew/account', 'App\HTTP\Controllers\AccountController@get_user_change');
    Route::post('/petcrew/account/pwd', 'App\HTTP\Controllers\AccountController@user_pwd_change');
    Route::post('/petcrew/account/email', 'App\HTTP\Controllers\AccountController@user_email_change');
});
