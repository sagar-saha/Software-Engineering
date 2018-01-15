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




Route::get('/','drugmrt@index');
Route::get('add-product','drugmrt@add');
Route::post('insert','drugmrt@insert');
Route::get('stat','drugmrt@stat');
Route::get('/edit/{id}','drugmrt@edit');
Route::get('/del/{id}','drugmrt@del');
Route::get('/order/{id}','drugmrt@order');
Route::get('/pay/','drugmrt@pay');
Route::post('/update/{id}','drugmrt@update');
Route::post('ajax/add','drugmrt@ajax_update');
Route::get('/search','drugmrt@search');
Route::get('/autocomplete', array('as' => 'autocomplete', 'uses'=>'drugmrt@autocomplete')); //Instead of Theme your Controller name
Route::get('/sell','drugmrt@sell');
Route::get('/profile','drugmrt@profile');
Route::post('/proupdate/','drugmrt@proupdate');
Auth::routes();
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('logout', 'drugmrt@logout');
Route::get('/contact', 'drugmrt@contact');
Route::get('/about', 'drugmrt@about');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();


