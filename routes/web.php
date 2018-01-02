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

Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');

Route::group(['prefix' => '/admin', 'middleware' => ['admin']], function () {

    Route::get('', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/floors', 'AdminController@floors');
    Route::get('/floor/insert', 'AdminController@floorInsertForm');
    Route::post('/floor/insert', 'AdminController@floorUpdate');
    Route::get('/floor/edit/{id}', ['uses' =>'AdminController@floorEditForm']);
    Route::post('/floor/edit/{id}', ['uses' =>'AdminController@floorUpdate']);
    Route::get('/floor/delete/{id}', ['uses' =>'AdminController@floorDelete']);
});
