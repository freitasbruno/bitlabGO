<?php

namespace App\Http\Controllers;

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
        $item = new Timer;
		$item->id_user = Auth::user()->id;
    	$item->id_parent = session('currentGroup')->id ?? 0;
		$item->name = $request->get('name');
		$item->start = now();
		$item->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Timer  $timer
     * @return \Illuminate\Http\Response
     */
    public function show(Timer $timer)
    {
        //
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
		$itemId = $_POST['itemId'];

		$item = Timer::find($itemId);
		$item->stop = now();
		$item->save();
        return $item->stop;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timer  $timer
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $item = Timer::find($id);
		$item->delete();
        return back();
    }
}
