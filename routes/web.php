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
//Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard', ['uses' =>'DashboardController@index']);

Route::get('/floors', ['uses' =>'UserController@index']);
Route::get('/room/{id}/{ip_address}', ['uses' =>'UserController@room']);
Route::get('/task/{id}/{ip_address}', ['uses' =>'UserController@task']);
Route::get('/item-status/{id}/{ip_address}',['uses' =>'UserController@taskStatus']);

Route::group(['prefix' => '/admin', 'middleware' => ['admin']], function () {

    Route::get('', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index');

    Route::get('/floors', 'AdminController@floors');
    Route::get('/floor/insert', 'AdminController@floorInsertForm');
    Route::post('/floor/insert', 'AdminController@floorUpdate');
    Route::get('/floor/edit/{id}', ['uses' =>'AdminController@floorEditForm']);
    Route::post('/floor/edit/{id}', ['uses' =>'AdminController@floorUpdate']);
    Route::get('/floor/delete/{id}', ['uses' =>'AdminController@floorDelete']);

    Route::get('/users', ['uses' =>'AdminController@users']);
    Route::get('/user/edit/{id}', ['uses' =>'AdminController@userEditForm']);
    Route::post('/user/edit/{id}', ['uses' =>'AdminController@userUpdate']);
    Route::get('/user/delete/{id}', ['uses' =>'AdminController@userDelete']);

    Route::get('/rooms', 'AdminController@rooms');
    Route::get('/room/insert', 'AdminController@roomInsertForm');
    Route::post('/room/insert', 'AdminController@roomUpdate');
    Route::get('/room/edit/{id}', ['uses' =>'AdminController@roomEditForm']);
    Route::post('/room/edit/{id}', ['uses' =>'AdminController@roomUpdate']);
    Route::get('/room/delete/{id}', ['uses' =>'AdminController@roomDelete']);

	Route::get('/items', 'AdminController@items');
	Route::get('/item/insert', 'AdminController@itemInsertForm');
	Route::post('/item/insert', 'AdminController@itemUpdate');
	Route::get('/item/edit/{id}', ['uses' =>'AdminController@itemEditForm']);
	Route::post('/item/edit/{id}', ['uses' =>'AdminController@itemUpdate']);
	Route::get('/item/delete/{id}', ['uses' =>'AdminController@itemDelete']);

	Route::get('create-component-list','ComponentController@showCreateComponentListForm');
	Route::post('create-component-list','ComponentController@createComponentList');
	Route::get('edit-component-list/{id}','ComponentController@editComponentList');
	Route::get('list-component','ComponentController@showComponentList');

	Route::get('add-component/{list_id}','ComponentController@showCreateBuyComponentForm');
	Route::post('add-component','ComponentController@createBuyComponent');
	Route::get('view-component/{list_id}','ComponentController@viewBuyComponent');
	Route::get('edit-buy-component/{id}','ComponentController@editBuyComponent');
	Route::get('delete-buy-component/{id}','ComponentController@deleteBuyComponent');


	Route::get('resistor-list','ResistorController@showResistorList');
	Route::get('create-resistor','ResistorController@showCreateResistorForm');
	Route::post('create-resistor','ResistorController@createResistor');
	Route::get('edit-resistor/{id}','ResistorController@editResistor');
	Route::get('delete-resistor/{id}','ResistorController@deleteResistor');

	Route::post('show-resistors','ResistorController@showResistors');

    Route::get('/pump-ip/insert', 'AdminController@showPumpIpForm');
    Route::get('/water-level', 'AdminController@viewWaterLevel');
    Route::post('/pump-ip/insert', 'AdminController@insertPumpIp');

});
