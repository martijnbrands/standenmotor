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
    return $request->user()->with('team');
});

Route::group(['namespace' => 'Api'], function(){
    /* Place all your api routes here.
     * The controllers will be place in App\Http\Controllers\Api
     * Example: php artisan make:controller Api/PlayersController -r --model=Player
     */

    Route::post('/auth/register', 'AuthController@register');
    Route::post('auth/login', 'AuthController@login');
    Route::group(['middleware' => 'jwt.auth'], function(){
        Route::get('auth/user', 'AuthController@user');
        Route::post('auth/logout', 'AuthController@logout');
        Route::get('/teamId', 'TeamsController@getId');
    });
    Route::group(['middleware' => 'jwt.refresh'], function(){
        Route::get('auth/refresh', 'AuthController@refresh');
    });

    // Route::get('/teamId', 'TeamsController@getId');
    Route::get('/{teamId}/players', 'PlayersController@index');
});