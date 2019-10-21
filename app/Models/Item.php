<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;

class Item extends Model
{
	use SoftDeletes;
	
    /**
     * Get an array of the items that belong to a Group.
	 * Needs to be called statically from one of the classes that extends Item.
	 * Return Null is no items exist, or an array of Items who's id_parent matches the current Group id.
     *
     * @param  Group $group
     * @return array $items
     */
	static public function getItems(Group $group){
		$className = get_called_class();
		$items = $className::where('id_user', Auth::id())->where('id_parent', $group->id)->get();
		return $items->isEmpty() ? null : $items;		 
	}
}
