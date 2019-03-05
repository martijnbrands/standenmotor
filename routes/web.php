<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['namespace' => 'Admin'], function(){
    Route::get('/admin', 'AdminController@index');
    Route::post('/admin', 'LoginController@login')->name('admin.login');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => 'admin'], function(){

    /* PLAYERS */
    Route::get('/players', 'PlayersController@index')->name('admin.players.index');
    Route::get('/players/create', 'PlayersController@create')->name('admin.players.create');
    Route::post('/players/create', 'PlayersController@store')->name('admin.players.store');

    Route::get('/players/edit/{player}', 'PlayersController@edit')->name('admin.players.edit');
    Route::post('/players/edit/{player}', 'PlayersController@update')->name('admin.players.update');

    Route::delete('/players/delete/{player}', 'PlayersController@destroy')->name('admin.players.destroy');

    /* TEAMS */
    Route::get('/teams', 'TeamsController@index')->name('admin.teams.index');
    Route::get('/teams/create', 'TeamsController@create')->name('admin.teams.create');
    Route::post('/teams/create', 'TeamsController@store')->name('admin.teams.store');

    Route::get('/teams/edit/{team}', 'TeamsController@edit')->name('admin.teams.edit');
    Route::post('/teams/edit/{team}', 'TeamsController@update')->name('admin.teams.update');

    Route::delete('/teams/delete/{team}', 'TeamsController@destroy')->name('admin.teams.destroy');

    Route::get('/teams/{team}', 'TeamsController@show');

    /* USERS */
    Route::get('/users', 'UsersController@index')->name('admin.users.index');
    Route::get('/users/create', 'UsersController@create')->name('admin.users.create');
    Route::post('/users/create', 'UsersController@store')->name('admin.users.store');

    Route::get('/users/edit/{user}', 'UsersController@edit')->name('admin.users.edit');
    Route::post('/users/edit/{user}', 'UsersController@update')->name('admin.users.update');

    Route::delete('/users/delete/{user}', 'UsersController@destroy')->name('admin.users.destroy');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', 'PlayerController@index');
});