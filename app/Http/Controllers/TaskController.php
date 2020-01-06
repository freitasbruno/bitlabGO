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
		$items = Item::has('task')
			->where('id_user', Auth::user()->id)
			->where('id_parent', session('currentGroup')->id)
			->with('task')->get();
		
		$returnHTML = view('panels.itemPanel')->with([
			'itemType' => 'task', 
			'title' => 'TASKS', 
			'items' => $items])
			->render();

		return response()->json(array(
			'success' => true,
			'items' => $items, 
			'html' => $returnHTML));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$html = view('forms.newItemForm')->with(['itemType' => 'task'])->render();
		return response()->json(array(
			'success' => true,
			'type' => 'task',
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

		$item = Item::create([
			'id_user' => $id_user,
			'id_parent' => $currentGroup,
			'name' => $request->get('name')
		]);
		
		$task = Task::create([
			'id_user' => $id_user,
			'id_parent' => $item->id
		]);

        return response()->json($task);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
		$cardHtml = view('cards.taskCard')->with('item', $task->item)->render();
		$modalHtml = view('cards.taskDetailCard')->with('item', $task->item)->render();
		return response()->json(array(
			'success' => true,
			'item' => $task->item, 
			'cardHtml' => $cardHtml,
			'modalHtml' => $modalHtml
		));
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
	public function update(Request $request, Task $task)
	{		
		$field = $request->get('field');
		$content = $request->get($field);

		if ($field == 'name' || $field == 'description') {
			$task->item->$field = $content;
			$task->item->save();
		} else {
			$task->$field = $content;
			$task->save();
		}

		$modalHtml = view('cards.taskDetailCard')->with('item', $task->item)->render();

		return response()->json(array(
			'success' => true,
			'type' => 'task',
			'task' => $task->toJson(),
			'modalHtml' => $modalHtml
		));
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
    public function destroy(Task $task)
    {
		$task->delete();
		return response()->json(array(
			'success' => true,
			'type' => 'task',
			'task' => $task->toJson()
		));
	}
			
	/**
     * Get a form to update a specific field.
     *
     */	
    public function getForm(Task $task)
    {
		$field = $_POST['field'];

		if ($field == 'name' || $field == 'description') {
			$html = view('forms.fieldForm')->with(['field' => $field, 'content' => $task->item->$field])->render();
		} else {
			$html = view('forms.fieldForm')->with(['field' => $field, 'content' => $task->$field])->render();
		}
		
		return response()->json(array(
			'success' => true,
			'type' => 'task',
			'field' => $field,
			'html' => $html
		));
	}
}
