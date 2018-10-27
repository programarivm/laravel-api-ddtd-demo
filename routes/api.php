<?php

use Illuminate\Http\Request;

Route::post('/auth', 'AuthController@auth');

Route::group(['middleware' => ['jwt']], function () {
    Route::get('/team/{season}', 'TeamController@index');
    Route::post('/team/create', 'TeamController@store');
    Route::put('/team/update/{id}', 'TeamController@update');
    Route::delete('/team/delete/{id}', 'TeamController@destroy');
});
