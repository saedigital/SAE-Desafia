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

Route::get('/', 'EspetaculoController@index');
Route::resource('espetaculos', 'EspetaculoController');
Route::get('/reservas/create/{poltronas}/{espetaculo}', 'ReservaController@create');
Route::post('/reservas/', 'ReservaController@store');
Route::get('/reservas/remove/{poltronas}/{espetaculo}', 'ReservaController@remove');
