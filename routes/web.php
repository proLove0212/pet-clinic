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
    return redirect('/petcrew2');
});

Route::get('/petcrew2', function () {
    return view('welcome');
});

Route::get('/petcrew2/login', function () {
    return view('auth.user.login');
});

Route::get('/petcrew2/admin/login', function () {
    return view('auth.admin_login');
});


Route::get('/maintain', 'App\HTTP\Controllers\AuthController@notification');

Route::post('/logout', 'App\HTTP\Controllers\AuthController@logout');

Route::post('/admin/login', 'App\HTTP\Controllers\AuthController@admin_login')->name('admin_login');

Route::middleware(['maintain'])->group(function () {
    Route::post('/petcrew2/login', 'App\HTTP\Controllers\AuthController@user_login')->name('user_login');

    Route::get('/petcrew2/account/password/reset_1', 'App\HTTP\Controllers\UserForgotController@index_pwd');
    Route::post('/petcrew2/account/password/reset_1', 'App\HTTP\Controllers\UserForgotController@reset_pwd');
    Route::get('/petcrew2/account/password/reset_2', 'App\HTTP\Controllers\UserForgotController@index_all');
    Route::post('/petcrew2/account/password/reset_2', 'App\HTTP\Controllers\UserForgotController@reset_all');

});

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

    Route::get('/admin/account', 'App\HTTP\Controllers\AccountController@get_admin_change');
    Route::post('/admin/account', 'App\HTTP\Controllers\AccountController@admin_change');
});


Route::middleware(['customAuth:user', 'maintain'])->group(function () {
    Route::get('/petcrew2/dashboard', 'App\HTTP\Controllers\UserDashboardController@index');

    Route::get('/petcrew2/search', 'App\HTTP\Controllers\SearchController@index');
    Route::post('/petcrew2/search', 'App\HTTP\Controllers\SearchController@search');
    Route::post('/petcrew2/search/name', 'App\HTTP\Controllers\SearchNameController@search');

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

    Route::get('/user/account', 'App\HTTP\Controllers\AccountController@get_user_change');
    Route::post('/user/account', 'App\HTTP\Controllers\AccountController@user_change');
});

Route::post('/petcrew/data_update_single.php', 'App\HTTP\Controllers\APIDataController@index');
Route::get('/petcrew/get_receptionlist.php', 'App\HTTP\Controllers\APIReceptionController@index');
Route::post('/petcrew/reception_enable.php', 'App\HTTP\Controllers\APIReceptionController@enable');
Route::post('/petcrew/reception_entry.php', 'App\HTTP\Controllers\APIReceptionController@entry');
