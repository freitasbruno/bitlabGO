<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item as Item;
use App\Models\Items\Cash as Cash;
use App\Models\Group as Group;

class CashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "hello from CashController";
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
			'name' => $request->get('cashName')
		]);

		$cash = Cash::create([
			'id_user' => $id_user,
			'id_parent' => $item->id,
			'id_account' => $request->get('id_account'),
			'type' => $request->get('type'),
			'amount' => $request->get('amount'),
			'currency' => $request->get('currency'),
			'recurring' => $request->get('recurring') ? $request->get('recurring') : false,
			'interval' => $request->get('interval')
		]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function show(Cash $cash)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$cash = Cash::find($id);
		$item = Item::find($cash->id_parent);
		$accounts = Group::has('account')->where('id_user', Auth::user()->id)->with('account')->get();

		return view('editCash', ['item' => $item, 'cash' => $cash, 'accounts' => $accounts]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
		$item = Cash::find($id);
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
     * @param  int  $id
     */
    public function destroy($id)
    {
		$cash = Cash::find($id);
		$item = Item::find($cash->id_parent);
		$cash->delete();
		$item->delete();
		return back();
	}
}
