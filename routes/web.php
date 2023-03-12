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
})->name('login');

Route::get('/petcrew/admin/login', function () {
    return view('auth.admin.login');
})->name('admin.login');


Route::get('/petcrew/maintain', 'App\HTTP\Controllers\AuthController@notification');

Route::post('/logout', 'App\HTTP\Controllers\AuthController@logout');

Route::post('/petcrew/admin/login', 'App\HTTP\Controllers\Auth\LoginController@adminLogin')->name('admin.login');

Route::post('/petcrew/login', 'App\HTTP\Controllers\Auth\LoginController@userLogin')->name('user.login');

Route::get('/petcrew/account/password/reset_1', 'App\HTTP\Controllers\Auth\ForgotPasswordController@index_pwd')->name("user.forgot.type1");
Route::post('/petcrew/account/password/reset_1', 'App\HTTP\Controllers\Auth\ForgotPasswordController@reset_pwd')->name("user.forgot.type1");
Route::get('/petcrew/account/password/reset_2', 'App\HTTP\Controllers\Auth\ForgotPasswordController@index_all')->name("user.forgot.type2");
Route::post('/petcrew/account/password/reset_2', 'App\HTTP\Controllers\Auth\ForgotPasswordController@reset_all')->name("user.forgot.type2");


Route::middleware(['auth:admin'])->group(function () {
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

    Route::get('/petcrew/admin/account', 'App\HTTP\Controllers\Auth\AccountController@get_admin_change')->name('admin.account');
    Route::post('/petcrew/admin/account/pwd', 'App\HTTP\Controllers\Auth\AccountController@admin_pwd_change')->name('admin.account.password');
    Route::post('/petcrew/admin/account/email', 'App\HTTP\Controllers\Auth\AccountController@admin_email_change')->name('admin.account.email');
});


Route::middleware(['auth'])->group(function () {
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

    Route::get('/petcrew/account/pwd_reset', 'App\HTTP\Controllers\Auth\PasswordResetController@index')->name('user.password.reset');
    Route::post('/petcrew/account/pwd_reset', 'App\HTTP\Controllers\Auth\PasswordResetController@reset')->name('user.password.reset');
    Route::get('/petcrew/customer/info/{id}', 'App\HTTP\Controllers\SearchController@getCustomerInfo');

    Route::get('/petcrew/account', 'App\HTTP\Controllers\Auth\AccountController@get_user_change')->name('user.account');
    Route::post('/petcrew/account/pwd', 'App\HTTP\Controllers\Auth\AccountController@user_pwd_change')->name('user.account.password');
    Route::post('/petcrew/account/email', 'App\HTTP\Controllers\Auth\AccountController@user_email_change')->name('user.account.email');
});
