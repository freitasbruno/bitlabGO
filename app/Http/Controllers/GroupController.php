<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Group as Group;
use App\Models\Items\ItemCash as ItemCash;
use View;
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
		$group->name = $request->get('name');
		$group->description = $request->get('description');
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
		$cashItems = ItemCash::getGroupItems($id);

		// Change the currentGroup in the Session
		session(['currentGroup' => Group::find($id)]);

        // load the view and pass the groups
        return view('home', [
			'groups' => $groups, 
			'groupHierarchy' => $groupHierarchy,
			'cashItems' => $cashItems
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
		$group->name = $request->get('name');
		$group->description = $request->get('description');
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
