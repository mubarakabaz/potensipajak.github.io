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

Route::get('/', 'PbbMapController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
 * Pbbs Routes
 */
Route::get('/our_pbbs', 'PbbMapController@index')->name('pbb_map.index');
Route::resource('pbbs', 'PbbController');
