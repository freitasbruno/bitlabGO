<?php

namespace App\Models\Items;

use App\Models\Item as Item;
use App\Models\Account as Account;
use Illuminate\Support\Facades\Auth;

class ItemCash extends Item
{

	protected $table = 'item_cash';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'amount', 'currency', 'recurring', 'interval'
	];

	/**
     * Get an array with the Totals of income and expenses for a given group.
	 * Return Null is no items exist, or an array containing 3 key value pairs for Expenses, Income and Balance with their values.
     *
     * @param  int $id
     * @return array $totals
     */
	static public function getGroupTotals(int $id){
		$totalExpense = self::where('id_user', Auth::id())
			->where('id_parent', $id)
			->where('type', 'expense')
			->sum('amount');
		$totalIncome = self::where('id_user', Auth::id())
			->where('id_parent', $id)
			->where('type', 'income')
			->sum('amount');
		$balance = $totalIncome - $totalExpense;

		return ['expense'=>$totalExpense, 'income'=>$totalIncome, 'balance'=>$balance];		 
	}

		
    /**
     * Get an array of the items that belong to a Group.
	 * Needs to be called statically from one of the classes that extends Item.
	 * Return Null is no items exist, or an array of Items who's id_parent matches the current Group id.
     *
     * @param int $id
     * @return array $items
     */
	static public function getItems(int $id){
		$items = ItemCash::where('id_user', Auth::id())->where('id_parent', $id)->get();
		
		if ($items->isNotEmpty()){
			foreach ($items as $item) {
				$item->account = Account::find($item->id_account);
			}
			return $items;
		} else {
			return null;
		}
	}
}
