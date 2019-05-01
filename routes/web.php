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

Route::get('/', 'LoginController@index')->name('login');
Route::post('/', 'LoginController@dologin');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/download/storage/tmp/{file}', 'CropperController@download')->name('download');

Route::post('/create', 'CropperController@imgfix')->name('imgfix');
Route::get('/edit/presets', 'CropperController@editPresets');
Route::get('/delete/{id}', 'CropperController@destroyPreset');
