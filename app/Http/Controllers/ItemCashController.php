<?php

namespace App\Http\Controllers;

use App\Models\Items\ItemCash as ItemCash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "hello from ItemCashController";
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
		$item = new ItemCash;
		$item->id_user = Auth::user()->id;
    	$item->id_parent = session('currentGroup')->id ?? 0;
		$item->name = $request->get('name');
		$item->amount = $request->get('amount');
		$item->type = $request->get('type');
		$item->currency = $request->get('currency');
		$item->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemCash  $itemCash
     * @return \Illuminate\Http\Response
     */
    public function show(ItemCash $itemCash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemCash  $itemCash
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$item = ItemCash::find($id);
		return view('editCashItem', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemCash  $itemCash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$item = ItemCash::find($id);
		$item->name = $request->get('name');
		$item->amount = $request->get('amount');
		$item->type = $request->get('type');
		$item->currency = $request->get('currency');
		$item->save();

		$id_parent = session('currentGroup')->id ?? null;
        // load the view and pass the groups
        return redirect('home/' . $id_parent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemCash  $itemCash
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$itemCash = ItemCash::find($id);
		$itemCash->delete();
        return back();
	}
}
