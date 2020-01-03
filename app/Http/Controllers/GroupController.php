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
	public function index()
	{		
		$user = Auth::user();
		$breadcrumbs = session('currentGroup')->getBreadcrumbs();
		$groupTree = Group::getGroupTree($user->id_home);
	
		$returnHTML = view('panels.groupPanel')->with(['groups' => $groupTree->groups, 'breadcrumbs' => $breadcrumbs])->render();
		return response()->json(array(
			'success' => true,
			'groups' => $groupTree,
			'breadcrumbs' => $breadcrumbs,
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
		$modalHtml = view('cards.groupDetailCard')->with('group', $group)->render();
		
		return response()->json(array(
			'success' => true,
			'type' => 'group',
			'group' => $group->toJson(),
			'modalHtml' => $modalHtml
		));
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
