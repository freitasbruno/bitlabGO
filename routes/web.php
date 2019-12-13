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
	return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::resource('home', 'HomeController');
	Route::resource('groups', 'GroupController');
	Route::resource('accounts', 'AccountController');
	//Route::resource('cash', 'CashController');
	Route::resource('bookmarks', 'BookmarkController');
	
	Route::post('tasks/toggleComplete', 'TaskController@toggleComplete');
	Route::resource('tasks', 'TaskController');
	
	Route::post('timers/stop', 'TimerController@stop');
	Route::resource('timers', 'TimerController');
	
	Route::post('cash/getItem', 'CashController@getItem');
	Route::post('accounts/getAccount', 'AccountController@getAccount');
});


use App\Models\Items\Timer;

Route::get('/test', function () {

	$timer = Timer::find(1);
	echo date_diff(date_create($timer->stop), date_create($timer->start))->format('%Y-%m-%d %H:%i:%s');
	return;
});
