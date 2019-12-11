<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('books', 'BookController')->middleware('check_token');

Route::apiResource('users', 'UserController');

Route::get('showBooks', 'BookController@showBooks')->middleware('check_token');

Route::post('login', 'UserController@login');

Route::post('lend', 'UserController@lend')->middleware('check_token');
