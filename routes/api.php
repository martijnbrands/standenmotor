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

    /* AUTHENTICATION */
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

    /* PLAYERS */
    Route::group(['middleware' => 'jwt.auth'], function(){

        /* PLAYERS */
        Route::post('/players/create', 'PlayersController@store');
        Route::patch('/players/update/{player}', 'PlayersController@update');

        /* MATCHES */
        Route::get('/matches/{teamId}', 'MatchesController@index');
        Route::post('/matches/create', 'MatchesController@create');
    });

    Route::delete('/players/delete/{player}', 'PlayersController@destroy');

    Route::get('/teams/{teamId}/players', 'PlayersController@index');
});