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
    return view('auth.login');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function(){
  //Route::get('/', 'HomeController@index')->name('home');
  Route::get('clients', 'ClientController@index')->name('clients');

  Route::get('reports', function() {
    return view('reports');
  })->name('reports');
});

Route::group(['prefix' => 'clients', 'middleware' => 'auth'], function(){
  Route::get('/', 'ClientController@getClients');
  Route::post('/', 'ClientController@store');
  Route::get('/{id}','ClientController@show');
  Route::get('/car-dealerships/{id}','ClientController@getCarShips');
  Route::delete('/{id}', 'ClientController@destroy');
  Route::put('/{id}', 'ClientController@update');
});

Route::group(['prefix' => 'car-dealerships', 'middleware' => 'auth'],function(){
  Route::get('/', 'HomeController@getCarShips');
});

Auth::routes();
