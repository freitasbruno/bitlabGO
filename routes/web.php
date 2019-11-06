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
use App\Models\User;
use App\Models\Account;

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::resource('home', 'GroupController');
Route::resource('accounts', 'AccountController');
Route::resource('cashItems', 'CashItemController');

Route::post('tasks/toggleComplete', 'TaskController@toggleComplete');
Route::resource('tasks', 'TaskController');

Route::get('/test/{id}', function ($id) {
	$a = Account::where('id', '=', $id)->with('cashItems')->get();
	return dd($a);
});
