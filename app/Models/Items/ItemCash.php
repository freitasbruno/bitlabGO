<?php

namespace App\Models\Items;

use App\Models\Item as Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        'name', 'description', 'amount', 'currency'
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
}
