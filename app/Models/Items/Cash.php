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
        return $this->belongsTo('App\Models\Item', 'id_parent');
	}
	
	/**
     * Get the parent group of a group.
     */
    public function account()
    {
        return $this->belongsTo('App\Models\Group', 'id_account');
	}
}