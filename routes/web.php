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

// Authtentication routes
Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');

// routes for the front-end application
Route::get('/', ['as' => 'contest.home', 'uses' => 'ContestController@index']);
Route::prefix('contest')->group(function() {
	Route::get('/', ['as' => 'contest.index', 'uses' => 'ContestPhotosController@index']);
	Route::group(['middleware' => ['auth']], function () {
		Route::post('/add', ['as' => 'contest.store', 'uses' => 'ContestPhotosController@store']);
		Route::prefix('votes')->group(function() {
			Route::post('like/add/{contest_photos_id}', ['as' => 'votes.storeLike', 'uses' => 'VotesController@storeLike']);
			Route::delete('like/remove/{contest_photos_id}', ['as' => 'votes.unLike', 'uses' => 'VotesController@unLike']);
			Route::post('superlike/add/{contest_photos_id}', ['as' => 'votes.storeSuperLike', 'uses' => 'VotesController@storeSuperLike']);
		});
	});
});

// routes for the back-end application which is used by the administrators
Route::group(['middleware' => ['auth']], function () {
	Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function() {
		Route::get('', ['as' => 'admin.index', 'uses' => 'AdminController@index']);
		Route::prefix('participants')->group(function() {
			Route::get('', ['as' => 'participants', 'uses' => 'UserController@index']);
			Route::get('change/{user_id}', ['as' => 'participants.change', 'uses' => 'UserController@change']);
			Route::get('disqualify/{user_id}', ['as' => 'participants.disqualify', 'uses' => 'UserController@disqualify']);
			Route::get('delete/{user_id}', ['as' => 'participants.delete', 'uses' => 'UserController@destroy']);
		});
		Route::prefix('contests')->group(function() {
			Route::get('', ['as' => 'contests.index', 'uses' => 'ContestController@getContests']);
			Route::get('edit/{contest_id}', ['as' => 'contests.show', 'uses' => 'ContestController@getContestById']);
			Route::put('edit/{contest_id}', ['as' => 'contests.edit', 'uses' => 'ContestController@update']);
			Route::get('add', ['as' => 'contests.form', 'uses' => 'ContestController@showForm']);
			Route::post('add', ['as' => 'contests.add', 'uses' => 'ContestController@store']);
			Route::delete('{contest_id}', ['as' => 'contests.delete', 'uses' => 'ContestController@destroy']);
		});
	});
});

// Routes for email
Route::get('/send', 'EmailController@send');

// Routes to login & register in facebook
Route::get('login/facebook', ['as' => 'login.facebook', 'uses' => 'Auth\LoginController@redirectToProvider']);
Route::get('login/facebook/callback', ['as' => 'login.facebook.callback', 'uses' => 'Auth\LoginController@handleProviderCallback']);