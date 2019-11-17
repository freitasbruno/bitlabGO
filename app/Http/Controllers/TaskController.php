<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Items\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
		$id_user = Auth::user()->id;
		$currentGroup = session('currentGroup')->id;

		$item = Item::create([
			'id_user' => $id_user,
			'id_parent' => $currentGroup,
			'name' => $request->get('taskName')
		]);
		
		$task = Task::create([
			'id_user' => $id_user,
			'id_parent' => $item->id
		]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
		$task = Task::find($id);
		$item = Item::find($task->id_parent);
		$item->name = $request->get('taskName');
		$item->save();

        return back();
	}

	/**
     * Toggle the complete status of a task.
     *
     */	
    public function toggleComplete()
    {
		$taskId = $_POST['taskId'];

		$task = Task::find($taskId);
		$task->complete = !$task->complete;
		$task->save();
        return "task complete toggled";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
		$task = Task::find($id);
		$item = Item::find($task->id_parent);
		$task->delete();
		$item->delete();
        return back();
    }
}
