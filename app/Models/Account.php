<?php

namespace App\Models;

use App\Models\Group;

class Account extends Group
{	
	
	/**
     * Get the parent group of the account.
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'id_parent');
	}
}
