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

// Rutas CRUD ajax
Route::get('crud', 'PersonController@index');
Route::post('crud', 'PersonController@add');
Route::get('crud/view', 'PersonController@view');
Route::post('crud/update', 'PersonController@update');
Route::post('crud/delete', 'PersonController@delete');
