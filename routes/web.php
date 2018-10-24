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

Route::get('/', 'ElectionController@show');
Route::get('/login', 'ElectionController@loginView');
Route::post('/login','ElectionController@login');
Route::post('/logout','ElectionController@logout');
Route::post('/update/{id}', 'ElectionController@updateVoting');
