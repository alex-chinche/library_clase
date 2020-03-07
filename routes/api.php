<?php

use Illuminate\Http\Request;

Route::post('createUser', 'UserController@createUser');
Route::post('loginUser', 'UserController@loginUser');


Route::group(['middleware' => ['auth']], function () {
    Route::post('lend', 'LendController@lend');
    Route::post('createBook', 'BookController@createBook');

    Route::post('lendBook', 'LendController@lendBook');
});
