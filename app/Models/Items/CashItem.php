<?php

namespace App\Models\Items;

use App\Models\Item as Item;

class CashItem extends Item
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
     * Get the user who owns the group.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
	}

	/**
     * Get the parent group of a group.
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Group', 'id_parent');
	}
	
	/**
     * Get the parent group of a group.
     */
    public function account()
    {
        return $this->belongsTo('App\Models\Group', 'id_account');
	}
}
