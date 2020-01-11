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

use App\Models\Group;
use App\Models\Item;
use App\Models\Items\Cash;
use App\Models\Items\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::resource('home', 'HomeController');

	Route::resource('groups', 'GroupController');
	Route::post('groups/current', 'GroupController@updateCurrentGroup');

	Route::post('groups/move/{group}', 'GroupController@move');
	Route::post('cash/move/{cash}', 'CashController@move');
	Route::post('tasks/move/{task}', 'TaskController@move');
	Route::post('timers/move/{timer}', 'TimerController@move');
	Route::post('bookmarks/move/{bookmark}', 'BookmarkController@move');
	
	Route::post('groups/getForm/{group}', 'GroupController@getForm');
	Route::post('accounts/getForm/{account}', 'AccountController@getForm');
	Route::post('cash/getForm/{cash}', 'CashController@getForm');
	Route::post('tasks/getForm/{task}', 'TaskController@getForm');
	Route::post('timers/getForm/{timer}', 'TimerController@getForm');
	Route::post('bookmarks/getForm/{bookmark}', 'BookmarkController@getForm');

	Route::resource('cash', 'CashController');

	Route::resource('bookmarks', 'BookmarkController');
	
	Route::resource('tasks', 'TaskController');
	Route::post('tasks/toggleComplete', 'TaskController@toggleComplete');
	
	Route::resource('timers', 'TimerController');
	Route::post('timers/start', 'TimerController@start');
	Route::post('timers/stop', 'TimerController@stop');
	
	Route::resource('accounts', 'AccountController');
	Route::post('accounts/getAccount', 'AccountController@getAccount');

	Route::get('/session', function () {
		$session = session()->all();
		dd($session['currentGroup']->toArray());
	});
});


use App\Models\Items\Timer;

Route::get('/test', function () {

	$task = Cash::find(1);
	dd($task->getTable());die;
});
