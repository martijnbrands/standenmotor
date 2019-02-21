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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function()
{

    Route::get('/admins', 'UsersController@admins')->name('admins');

    Route::get('/users', 'UsersController@index')->name('users');
    Route::get('/users/create', 'UsersController@create')->name('users.create');
    Route::post('/users/create', 'UsersController@store')->name('users.store');
    // Route::get('/users/{team}', 'UsersController@edit')->name('users.edit');
    // Route::patch('/users/{team}', 'UsersController@update')->name('users.update');
    // Route::delete('/users/{team}', 'UsersController@destroy')->name('users.delete');

    Route::get('/teams', 'TeamsController@index')->name('teams');
    Route::get('/teams/create', 'TeamsController@create')->name('teams.create');
    Route::post('/teams/create', 'TeamsController@store')->name('teams.store');
    Route::get('/teams/{team}', 'TeamsController@edit')->name('teams.edit');
    Route::patch('/teams/{team}', 'TeamsController@update')->name('teams.update');
    Route::delete('/teams/{team}', 'TeamsController@destroy')->name('teams.delete');
    
    Route::get('/players', 'UsersController@players')->name('players');
});