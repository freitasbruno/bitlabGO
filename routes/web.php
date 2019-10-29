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
use App\Models\Items\ItemCash;

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::resource('/home', 'GroupController');
Route::resource('/accounts', 'AccountController');
Route::resource('/cashItems', 'ItemCashController');

Route::get('/test/{id}', function ($id) {
	$g = Group::find($id);
	return dd($g->groupHierarchy());
	return dd(Group::find($id)->children);
	return dd(User::find($id)->groups->pluck('id'));
	return Group::where('id_user', 1)->get()->random()->id;
});
