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

Route::group(['namespace' => 'Api'], function(){
    /* Place all your api routes here.
     * The controllers will be place in App\Http\Controllers\Api
     * Example: php artisan make:controller Api/PlayersController -r --model=Player
     */

    Route::get('/players/{team}', 'PlayersController@index');
});