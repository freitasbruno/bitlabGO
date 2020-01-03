<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Group as Group;
use App\Models\Item as Item;
use App\Models\Items\Cash as Cash;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{		
		$user = Auth::user();
		if ($request->id) {
			$currentGroup = Group::find($request->id);
			$groups = Group::where('id_parent', $currentGroup->id)
				->get();
			session(['currentGroup' => $currentGroup]);			
			
		} else {
			$groups = Group::where('id_parent', $user->id_home)
				->get();
		}

		$groupHierarchy = session('currentGroup')->buildHierarchy();

		$returnHTML = view('panels.groupPanel')->with(['groups' => $groups, 'breadcrumbs' => $groupHierarchy])->render();
		return response()->json(array(
			'success' => true,
			'id' => $request->id,
			'groups' => $groups,
			'breadcrumbs' => $groupHierarchy,
			'html' => $returnHTML));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$html = view('forms.groupForm')->render();
		return response()->json(array(
			'success' => true,
			'type' => 'group',
			'modalHtml' => $html));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$id_user = Auth::user()->id;
		$currentGroup = session('currentGroup')->id;

		$group = Group::create([
			'id_user' => $id_user,
			'id_parent' => $currentGroup,
			'name' => $request->name,
			'description' => $request->description
		]);

		return response()->json($group);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Group $group)
	{
		$cardHtml = view('cards.groupCard')->with('group', $group)->render();
		$modalHtml = view('cards.groupDetailCard')->with('group', $group)->render();
		
		return response()->json(array(
			'success' => true,
			'group' => $group->toJson(),
			'cardHtml' => $cardHtml,
			'modalHtml' => $modalHtml
		));

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
