<?php

use Illuminate\Http\Request;

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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::get('resources', 'ResourceController@index');
Route::get('resources/{resource}', 'ResourceController@show');
Route::post('resources', 'ResourceController@store');

Route::get('file/{id}', 'FileController@show');
