<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
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
		$accounts = Account::where('id_user', $user->id)->get();
	
		if ($viewType == 'cardPanel') {
			$returnHTML = view('panels.groupPanel')->with(['filters' => $accounts, 'type' => 'accounts'])->render();
		}
		return response()->json(array(
			'success' => true,
			'type' => $viewType,
			'accounts' => $accounts,
			'html' => $returnHTML));
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
		$user = Auth::user();
		$home = $user->id_home;

		$group = Group::create([
			'id_user' => $user->id,
			'id_parent' => $home,
			'name' => $request->name,
			'description' => $request->description
		]);

		$account = Account::create([
			'id_user' => $user->id,
			'id_parent' => $group->id,
			'balance' => 0,
			'currency' => 'EUR'
		]);

		return response()->json($account);
	}

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
	public function show(Account $account)
	{
		$modalHtml = view('cards.accountDetailCard')->with('account', $account)->render();
		
		return response()->json(array(
			'success' => true,
			'type' => 'account',
			'account' => $account->toJson(),
			'modalHtml' => $modalHtml
		));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
		$field = $request->get('field');
		$content = $request->get($field);

		if ($field == 'name' || $field == 'description') {
			$account->group->$field = $content;
			$account->group->save();
		} else {
			$account->$field = $content;
			$account->save();
		}

		$modalHtml = view('cards.accountDetailCard')->with('account', $account)->render();

		return response()->json(array(
			'success' => true,
			'type' => 'account',
			'account' => $account->toJson(),
			'modalHtml' => $modalHtml
		));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
	public function destroy(Account $account)
	{
		$account->group->delete();
		$account->delete();
		return response()->json(array(
			'success' => true,
			'type' => 'account',
			'account' => $account->toJson()
		));
	}
		
	/**
     * Update the current group.
     *
     */	
    public function setCurrent()
    {
		$id = $_POST['id'];

		$account = Account::find($id);
		session(['currentAccount' => $account]);

        return response()->json(array(
			'success' => true,
			'account' => $account->toJson()
		));
	}

	/**
     * Get a form to update a specific field.
     *
     */	
    public function getForm(Account $account)
    {
		$field = $_POST['field'];

		if ($field == 'name' || $field == 'description') {
			$html = view('forms.fieldForm')->with(['field' => $field, 'content' => $account->group->$field])->render();
		} else {
			$html = view('forms.fieldForm')->with(['field' => $field, 'content' => $account->$field])->render();
		}
		
		return response()->json(array(
			'success' => true,
			'type' => 'accounts',
			'field' => $field,
			'html' => $html
		));
	}
}
