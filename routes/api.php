<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('poli','ApiPoliController@get_all_poli');
Route::post('/poli/add','ApiPoliController@insert_poli');
Route::put('/poli/update/{id}','ApiPoliController@update_poli');
Route::delete('/poli/delete/{id}','ApiPoliController@delete_poli');