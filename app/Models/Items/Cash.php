<?php

namespace App\Models\Items;

use App\Models\Item as Item;

class Cash extends Item
{

	protected $table = 'cash';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_parent', 'id_account', 'type', 'amount', 'currency', 'recurring', 'interval'
	];

	/**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['item', 'account'];

	/**
     * Get the user who owns the group.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
	}

	/**
     * Get the parent group of a group.
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'id_parent');
	}
	
	/**
     * Get the parent account of a cash item.
     */
    public function account()
    {
        return $this->belongsTo('App\Models\Account', 'id_account');
	}

	public static function getTotals($items) {

		$totals = [
			'expense' => 0,
			'income' => 0,
			'balance' => 0,
			'type' => 'cash'
		];

		foreach ($items as $item) {
			$totals[$item->cash->type] += $item->cash->amount;
		}

		$totals['balance'] = $totals['income'] - $totals['expense'];
		$totals['income'] = number_format($totals['income'], 2);
		$totals['expense'] = number_format($totals['expense'], 2);
		$totals['balance'] = number_format($totals['balance'], 2);
		return $totals;
	}
}
