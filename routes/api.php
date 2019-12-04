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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('books', 'BookController')->middleware('check_token');

Route::apiResource('users', 'UserController');

Route::post('showBooks', 'BookController@showBooks')->middleware('check_token');

Route::post('login', 'UserController@login');

Route::post('lend', 'UserController@lend')->middleware('check_token');


