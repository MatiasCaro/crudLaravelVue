<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('/crud', 'CrudController')->middleware('auth');

Route::post('/uplodad-file','CrudController@uplodadFile')->middleware('auth');

Route::get('/get-files','CrudController@getFiles')->middleware('auth');

Route::get('/delete-file/{id}','CrudController@deleteFile')->middleware('auth');

Route::post('/edit-user-file', 'CrudController@editUserFile')->middleware('auth');
