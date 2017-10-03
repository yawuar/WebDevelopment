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

Route::get('/', ['as' => 'contest.index', 'uses' => 'ContestController@index']);

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
		Route::get('', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
		Route::prefix('participants')->group(function() {
			Route::get('', ['as' => 'participants', 'uses' => 'UserController@index']);
			Route::get('change/{user_id}', ['as' => 'participants.change', 'uses' => 'UserController@change']);
			Route::get('delete/{user_id}', ['as' => 'participants.delete', 'uses' => 'UserController@destroy']);
		});
	});
});

// facebook socialite
Route::get('login/facebook', ['as' => 'login.facebook', 'uses' => 'Auth\LoginController@redirectToProvider']);
Route::get('login/facebook/callback', ['as' => 'login.facebook.callback', 'uses' => 'Auth\LoginController@handleProviderCallback']);