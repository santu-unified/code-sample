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

Route::get('/index', 'UserController@index')->name('user-list');

Auth::routes();

Route::get('/user/profile', 'UserController@index')->name('user-profile');
Route::post('/user/update', 'UserController@editProfile')->name('user-update');
