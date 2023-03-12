<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['maintain'])->group(function () {

    Route::post('/petcrew/data_update_single.php', 'App\HTTP\Controllers\APIDataController@index');
    Route::get('/petcrew/get_receptionlist.php', 'App\HTTP\Controllers\APIReceptionController@index');
    Route::post('/petcrew/reception_enable.php', 'App\HTTP\Controllers\APIReceptionController@enable');
    Route::post('/petcrew/reception_entry.php', 'App\HTTP\Controllers\APIReceptionController@entry');

});
