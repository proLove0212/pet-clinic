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

Route::get('/petcrew/admin/login', function () {
    return view('auth.admin.login');
})->name('admin.login');

Route::post('/petcrew/admin/login', 'App\HTTP\Controllers\Auth\LoginController@adminLogin')->name('admin.login');
Route::get('/petcrew/notification', 'App\HTTP\Controllers\AuthController@notification')->name('notification');

Route::post('/logout', 'App\HTTP\Controllers\AuthController@logout')->name('logout');




Route::middleware(['maintain'])->group(function () {

    Route::get('/petcrew/login', 'App\HTTP\Controllers\Auth\LoginController@showUserLoginForm')->name('login');
    Route::post('/petcrew/login', 'App\HTTP\Controllers\Auth\LoginController@userLogin')->name('user.login');

    Route::get('/petcrew/account/password/reset_1', 'App\HTTP\Controllers\Auth\ForgotPasswordController@index_pwd')->name("user.forgot.type1");
    Route::post('/petcrew/account/password/reset_1', 'App\HTTP\Controllers\Auth\ForgotPasswordController@reset_pwd')->name("user.forgot.type1");
    Route::get('/petcrew/account/password/reset_2', 'App\HTTP\Controllers\Auth\ForgotPasswordController@index_all')->name("user.forgot.type2");
    Route::post('/petcrew/account/password/reset_2', 'App\HTTP\Controllers\Auth\ForgotPasswordController@reset_all')->name("user.forgot.type2");

});


Route::middleware(['auth:admin'])->group(function () {
    Route::get('/petcrew/admin', 'App\HTTP\Controllers\AdminController@index')->name('admin.users');

    Route::get('/petcrew/admin/users/add', 'App\HTTP\Controllers\AdminController@create')->name('admin.user.create');
    Route::post('/petcrew/admin/users/add', 'App\HTTP\Controllers\AdminController@store')->name('admin.user.create');

    Route::get('/petcrew/admin/users/edit/{id}', 'App\HTTP\Controllers\AdminController@edit')->name('admin.user.edit');
    Route::post('/petcrew/admin/users/edit/{id}', 'App\HTTP\Controllers\AdminController@update')->name('admin.user.edit');

    Route::post('/petcrew/admin/users/pwd_reset/{cid}', 'App\HTTP\Controllers\AdminController@pwd_reset')->name('admin.user.password');
    Route::delete('/petcrew/admin/users/delete/{cid}', 'App\HTTP\Controllers\AdminController@delete')->name('admin.user.delete');

    Route::get('/petcrew/admin/contact', 'App\HTTP\Controllers\AdminMailController@index')->name('admin.contact');
    Route::post('/petcrew/admin/contact/send', 'App\HTTP\Controllers\AdminMailController@send')->name('admin.mail');

    Route::get('/petcrew/admin/maintain', 'App\HTTP\Controllers\MaintainController@index')->name('admin.maintain');
    Route::post('/petcrew/admin/maintain', 'App\HTTP\Controllers\MaintainController@store')->name('admin.maintain.create');
    Route::delete('/petcrew/admin/maintain/delete/{id}', 'App\HTTP\Controllers\MaintainController@delete')->name('admin.maintain.delete');

    Route::get('/petcrew/admin/account', 'App\HTTP\Controllers\Auth\AccountController@get_admin_change')->name('admin.account');
    Route::post('/petcrew/admin/account/pwd', 'App\HTTP\Controllers\Auth\AccountController@admin_pwd_change')->name('admin.account.password');
    Route::post('/petcrew/admin/account/email', 'App\HTTP\Controllers\Auth\AccountController@admin_email_change')->name('admin.account.email');
});


Route::middleware(['auth', 'maintain'])->group(function () {

    Route::get('/petcrew/search', 'App\HTTP\Controllers\SearchController@index')->name('user.search');
    Route::post('/petcrew/search', 'App\HTTP\Controllers\SearchController@search')->middleware('user')->name('user.search');

    Route::get('/petcrew/upload', 'App\HTTP\Controllers\UploadController@index')->middleware('user')->name('user.upload');
    Route::post('/petcrew/upload', 'App\HTTP\Controllers\UploadController@store')->middleware('user')->name('user.upload');

    // Route::get('/reception/settings', 'App\HTTP\Controllers\ReceptionSettingController@index');
    // Route::post('/reception/settings', 'App\HTTP\Controllers\ReceptionSettingController@update');

    // Route::get('/reception/reason', 'App\HTTP\Controllers\ReceptionReasonController@index');
    // Route::post('/reception/reason', 'App\HTTP\Controllers\ReceptionReasonController@store');
    // Route::post('/reception/reason/order', 'App\HTTP\Controllers\ReceptionReasonController@swap');
    // Route::delete('/reception/reason/{id}', 'App\HTTP\Controllers\ReceptionReasonController@delete');

    Route::get('/petcrew/account/pwd_reset', 'App\HTTP\Controllers\Auth\PasswordResetController@index')->name('user.password.reset');
    Route::post('/petcrew/account/pwd_reset', 'App\HTTP\Controllers\Auth\PasswordResetController@reset')->name('user.password.reset');
    Route::get('/petcrew/customer/info/{id}', 'App\HTTP\Controllers\SearchController@getCustomerInfo')->middleware('user');

    Route::get('/petcrew/account', 'App\HTTP\Controllers\Auth\AccountController@get_user_change')->middleware('user')->name('user.account');
    Route::post('/petcrew/account/pwd', 'App\HTTP\Controllers\Auth\AccountController@user_pwd_change')->middleware('user')->name('user.account.password');
    Route::post('/petcrew/account/email', 'App\HTTP\Controllers\Auth\AccountController@user_email_change')->middleware('user')->name('user.account.email');
});
