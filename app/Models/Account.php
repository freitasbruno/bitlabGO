<?php

namespace App\Models;

use App\Models\Group ;
use App\Models\Items\Cash;

class Account extends Group
{	

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_user', 'id_parent', 'balance', 'currency'
	];
	
	/**
     * The relationships that should always be loaded.
     *
     * @var array
     */
	protected $with = ['group'];
	
	/**
     * Get the parent group of the account.
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'id_parent');
	}
		
	/**
     * Get the Cash Items of an account.
     */
    public function cash()
    {
		return $this->hasMany('App\Models\Items\Cash', 'id_account', 'id_parent');
	}
}
