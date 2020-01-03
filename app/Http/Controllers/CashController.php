<?php

namespace App\Http\Controllers;

use App\Models\Account;
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
		$items = Item::has('cash')
			->where('id_user', Auth::user()->id)
			->where('id_parent', session('currentGroup')->id)
			->with('cash')->get();
			
		$returnHTML = view('panels.cashPanel')->with('items', $items)->render();
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
		$accounts = Account::where('id_user', Auth::user()->id)->get();
		$html = view('forms.newItemForm')->with(['itemType' => 'cash', 'accounts' => $accounts])->render();
		return response()->json(array(
			'success' => true,
			'type' => 'cash item',
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

		$item = Item::create([
			'id_user' => $id_user,
			'id_parent' => $request->group,
			'name' => $request->name
		]);

		$cash = Cash::create([
			'id_user' => $id_user,
			'id_parent' => $item->id,
			'id_account' => $request->id_account,
			'type' => $request->type,
			'amount' => $request->amount,
			'currency' => $request->currency,
			'recurring' => $request->recurring ? $request->recurring : false,
			'interval' => $request->interval
		]);

        return response()->json($cash);
    }

    /**
     * Return the specified resource.
     *
     * @param  \App\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function show(Cash $cash)
    {		
		$cardHtml = view('cards.cashCard')->with('item', $cash->item)->render();
		$modalHtml = view('cards.cashDetailCard')->with('item', $cash->item)->render();
		return response()->json(array(
			'success' => true,
			'item' => $cash->item, 
			'cardHtml' => $cardHtml,
			'modalHtml' => $modalHtml
		));
	}
	
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cash  $cash
     * @return \Illuminate\Http\Response
     */
    public function edit(Cash $cash)
    {
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
