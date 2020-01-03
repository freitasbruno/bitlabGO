<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Items\Timer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TimerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$items = Item::has('timer')
			->where('id_user', Auth::user()->id)
			->where('id_parent', session('currentGroup')->id)
			->with('timer')->get();
		
		$returnHTML = view('panels.itemPanel')->with([
			'itemType' => 'timer', 
			'title' => 'TIMERS', 
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
		$html = view('forms.newItemForm')->with(['itemType' => 'timer'])->render();
		return response()->json(array(
			'success' => true,
			'type' => 'timer',
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
		
		$timer = Timer::create([
			'id_user' => $id_user,
			'id_parent' => $item->id,
			'start' => now()
		]);

        return response()->json($timer);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timer  $timer
     * @return \Illuminate\Http\Response
     */
    public function show(Timer $timer)
    {
		$cardHtml = view('cards.timerCard')->with('item', $timer->item)->render();
		$modalHtml = view('cards.timerDetailCard')->with('item', $timer->item)->render();
		return response()->json(array(
			'success' => true,
			'item' => $timer->item, 
			'cardHtml' => $cardHtml,
			'modalHtml' => $modalHtml
		));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timer  $timer
     * @return \Illuminate\Http\Response
     */
    public function edit(Timer $timer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timer  $timer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Timer $timer)
    {
        //
	}
	
	/**
     * Update the finish time of a timer.
     *
     */	
    public function stop()
    {
		$timerId = $_POST['itemId'];

		$timer = Timer::find($timerId);
		$timer->stop = now();
		$timer->save();

        return $timer->stop;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timer  $timer
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $timer = Timer::find($id);
        $item = Item::find($timer->id_parent);
		$timer->delete();
		$item->delete();
        return back();
    }
}
