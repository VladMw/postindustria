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
Route::get('/', ['uses' => 'PaginationController@index', 'as' => 'indexPage']);
Route::post('/page', ['uses'=>'PaginationController@page']);
Route::post('/abusers',['uses'=>'CompaniesController@abusers']);
Route::post('/fake', ['uses'=>'FakeController@fake']);

Route::group(['prefix'=>'add'], function(){
    Route::post('company', ['uses'=>'CompaniesController@add']);
    Route::post('user', ['uses'=>'UsersController@add']);
});

Route::group(['prefix'=>'delete'], function(){
   Route::post('/user', ['uses'=>'UsersController@del']);
   Route::post('/company', ['uses' => 'CompaniesController@del']);
});

Route::group(['prefix'=>'edit'], function(){
   Route::post('/user/{id?}', ['uses'=>'UsersController@edit']);
   Route::post('/company/{name?}', ['uses'=>'CompaniesController@edit']);
});