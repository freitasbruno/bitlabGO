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
		$viewType = $request->get('viewType');

		$user = Auth::user();
		$breadcrumbs = session('currentGroup')->getBreadcrumbs();
		$groupTree = Group::getGroupTree($user->id_home);
	
		if ($viewType == 'cardPanel') {
			$returnHTML = view('panels.groupPanel')->with(['filters' => $groupTree->groups, 'breadcrumbs' => $breadcrumbs, 'type' => 'groups'])->render();
		} else if ($viewType == 'groupSelect') {
			$returnHTML = view('panels.groupSelectPanel')->with(['groups' => $groupTree])->render();
		}
		return response()->json(array(
			'success' => true,
			'type' => $viewType,
			'groups' => $groupTree,
			'breadcrumbs' => $breadcrumbs,
			'html' => $returnHTML));
	}

	/**
	 * Render the form for creating a new resource.
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
	public function update(Request $request, Group $group)
	{		
		$field = $request->get('field');
		$content = $request->get($field);

		$group->$field = $content;
		$group->save();

		$modalHtml = view('cards.groupDetailCard')->with('group', $group)->render();

		return response()->json(array(
			'success' => true,
			'type' => 'group',
			'group' => $group->toJson(),
			'modalHtml' => $modalHtml
		));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Group $group)
	{
		$group->delete();
		return response()->json(array(
			'success' => true,
			'type' => 'group',
			'group' => $group->toJson()
		));
	}
	
	/**
     * Update the current group.
     *
     */	
    public function setCurrent()
    {
		$groupId = $_POST['id'];

		$group = Group::find($groupId);
		session(['currentGroup' => $group]);

        return response()->json(array(
			'success' => true,
			'group' => $group->toJson()
		));
	}
	
	/**
     * Move the specified resource to a new group.
     *
     */	
    public function move(Group $group)
    {
		$targetId = $_POST['targetId'];

		$group->id_parent = $targetId;
		$group->save();

		session(['currentGroup' => $group->parent]);

        return response()->json(array(
			'success' => true,
			'group' => $group->toJson()
		));
	}
	
	/**
     * Get a form to update a specific field.
     *
     */	
    public function getForm(Group $group)
    {
		$field = $_POST['field'];

		$html = view('forms.fieldForm')->with(['field' => $field, 'content' => $group->$field])->render();
		
		return response()->json(array(
			'success' => true,
			'type' => 'group',
			'field' => $field,
			'html' => $html
		));
	}
	

}
