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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index')->name('home');
Route::get('/getemployees', 'HomeController@getemployees');
Route::get('/getemployee/{id}', 'HomeController@getemployee')->name('getemployee');
Route::post('/savemployee', 'HomeController@saveemployee');
Route::post('/dropemployee', 'HomeController@dropemployee');
Route::get('/newemployee', 'HomeController@newemployee')->name('newemployee');
Route::post('/newemployee', 'HomeController@createemployee');
Route::post('/uploadfoto','AjaxController@uploadphoto');
Route::post('/dropphoto','AjaxController@dropphoto');

