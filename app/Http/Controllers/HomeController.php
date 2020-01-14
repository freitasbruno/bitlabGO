<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Group;

class HomeController extends Controller
{
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = Auth::user();
		$group = Group::find($user->id_home);
		
		// Change the currentGroup in the Session
		session(['currentGroup' => $group]);
		session(['currentAccount' => null]);
		
		// load the view and pass the groups
		return view('home');
	}
}
