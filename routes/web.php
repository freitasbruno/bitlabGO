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

use App\Models\Items\Cash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
	Route::resource('home', 'HomeController');
	Route::resource('groups', 'GroupController');
	
	Route::resource('cash', 'CashController');

	Route::resource('bookmarks', 'BookmarkController');
	
	Route::resource('tasks', 'TaskController');
	Route::post('tasks/toggleComplete', 'TaskController@toggleComplete');
	
	Route::resource('timers', 'TimerController');
	Route::post('timers/stop', 'TimerController@stop');
	
	Route::resource('accounts', 'AccountController');
	Route::post('accounts/getAccount', 'AccountController@getAccount');
});


use App\Models\Items\Timer;

Route::get('/test', function () {
	$cash = Cash::where('id_user', Auth::user()->id)
		->with('account.group')->get()->first();
	dd($cash);
});
