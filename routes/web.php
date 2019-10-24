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
use App\Models\Items\ItemCash;

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::resource('/home', 'GroupController');
Route::resource('/cashItems', 'ItemCashController');

Route::get('/test/{id}', function ($id) {
	$group = Group::find($id);
	$g = $group->groupHierarchy();
	//return ItemCash::getGroupTotals($id)['expense'];
	return dd($g->getBalance());   
});
