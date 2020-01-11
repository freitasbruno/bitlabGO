<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use App\Models\Item;
use App\Models\Account;
use App\Models\Items\Cash;
use App\Models\Items\Task;
use App\Models\Items\Bookmark;
use App\Models\Items\Timer;

class HomeController extends Controller
{
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$user = Auth::user();
		$group = Group::find($user->id_home);
		$groups = $group->getChildren();
		$breadcrumbs = $group->getBreadcrumbs();

		$items = Item::doesntHave('cash')->where('id_parent', $user->id_home)->get();
		
		$cash = $group->cash();
		$tasks = $group->tasks();
		$timers = $group->timers();
		$bookmarks = $group->bookmarks();
		
		$group->cashTotals = $group->getCashTotals();

		$accounts = Account::where('id_user', $user->id)->get();

		$n = 0;
		
		foreach ($accounts as $account) {
			$account->cashTotals = $account->getCashTotals();
		}
		
		$totals = $group->getBalance();

		// Change the currentGroup in the Session
		session(['currentGroup' => Group::find($user->id_home)]);
		
		// load the view and pass the groups
		return view('home', [
			'groups' => $groups,
			'breadcrumbs' => $breadcrumbs,
			'items' => $items->isEmpty() ? null : $items,
			'cash' => $cash->isEmpty() ? null : $cash,
			'tasks' => $tasks->isEmpty() ? null : $tasks,
			'timers' => $timers->isEmpty() ? null : $timers,
			'bookmarks' => $bookmarks->isEmpty() ? null : $bookmarks,
			'totals' => $totals,
			'accounts' => $accounts
		]);
	}
}
