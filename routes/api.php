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

Route::post('/auth', 'AuthController@auth');

Route::get('/team/{season}', 'TeamController@index');
Route::post('/team/create', 'TeamController@store');
Route::put('/team/update/{id}', 'TeamController@update');
Route::delete('/team/delete/{id}', 'TeamController@destroy');
