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

Route::get('/', ['uses' => 'ContestController@index']);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::prefix('admin')->group(function() {
		Route::get('', ['uses' => 'AdminController@index']);
		Route::prefix('participants')->group(function() {
			Route::get('', ['as' => 'participants', 'uses' => 'UserController@index']);
			Route::put('edit', ['as' => 'participants.edit', 'uses' => 'UserController@edit']);
			Route::delete('change', ['as' => 'participants.change', 'uses' => 'UserController@change']);
			Route::delete('delete', ['as' => 'participants.delete', 'uses' => 'UserController@destroy']);
		});
	});
});