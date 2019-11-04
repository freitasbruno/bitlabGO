<?php

namespace App\Models;

use App\Models\Group;

class Account extends Group
{	
	/**
     * Get the cashItems of an account.
     */
    public function cashItems()
    {
        return $this->hasMany('App\Models\Items\CashItem', 'id_account');
	}
}
