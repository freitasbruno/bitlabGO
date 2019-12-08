<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Group as Group;
use App\Models\Item as Item;
use App\Models\Items\Cash as Cash;
use Auth;


class GroupController extends Controller
{
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = Auth::user();
		return redirect('home/' . $user->id_home);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$group = new Group;
		$group->id_parent = session('currentGroup')->id ?? 0;
		$group->id_user = Auth::user()->id;
		$group->name = $request->get('groupName');
		$group->description = $request->get('groupDescription');
		$group->save();

		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$group = Group::find($id);
		$groups = $group->getChildren();
		$groupHierarchy = $group->buildHierarchy();

		$items = Item::doesntHave('cash')->where('id_parent', $id)->get();
		
		$cash = $group->cash();
		$tasks = $group->tasks();
		$timers = $group->timers();
		$bookmarks = $group->bookmarks();
		
		$group->cashTotals = $group->getCashTotals();
		$accounts = Group::has('account')->where('id_user', Auth::user()->id)->with('account')->get();
		foreach ($accounts as $account) {
			$account->cashTotals = $account->getCashTotals();
		}
		
		$totals = $group->getBalance();

		// Change the currentGroup in the Session
		session(['currentGroup' => Group::find($id)]);
		
		// load the view and pass the groups
		return view('home', [
			'groups' => $groups,
			'groupHierarchy' => $groupHierarchy,
			'items' => $items->isEmpty() ? null : $items,
			'cash' => $cash->isEmpty() ? null : $cash,
			'tasks' => $tasks->isEmpty() ? null : $tasks,
			'timers' => $timers->isEmpty() ? null : $timers,
			'bookmarks' => $bookmarks->isEmpty() ? null : $bookmarks,
			'totals' => $totals,
			'accounts' => $accounts
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$group = Group::find($id);
		return view('editGroup', ['group' => $group]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$group = Group::find($id);
		$group->name = $request->get('groupName');
		$group->description = $request->get('groupDescription');
		$group->save();

		$id_parent = session('currentGroup')->id ?? null;
		// load the view and pass the groups
		return redirect('home/' . $id_parent);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$group = Group::find($id);
		$group->delete();
		return back();
	}
}
