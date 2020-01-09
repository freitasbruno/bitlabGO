<?php

namespace App\Http\Controllers;

use App\Models\Account;
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
		$account = Account::find($id);

        // load the view and pass the groups
        return view('accounts', [
			'account' => $account,
			'cashItems' => $account->cashItems
		]);
	}	
	
    /**
     * Return the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAccount()
    {
		$accountId = $_POST['accountId'];
		$account = Account::where('id', $accountId)
			->with('cash')->first();
		
		$returnHTML = view('panels.accountPanel')->with('account', $account)->render();
		return response()->json(array(
			'success' => true,
			'items' => $account->cash, 
			'html' => $returnHTML));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
