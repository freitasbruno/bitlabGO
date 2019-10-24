<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use phpDocumentor\Reflection\Types\Integer;

class Item extends Model
{
	use SoftDeletes;
	
    /**
     * Get an array of the items that belong to a Group.
	 * Needs to be called statically from one of the classes that extends Item.
	 * Return Null is no items exist, or an array of Items who's id_parent matches the current Group id.
     *
     * @param int $id
     * @return array $items
     */
	static public function getItems(int $id){
		$className = get_called_class();
		$items = $className::where('id_user', Auth::id())->where('id_parent', $id)->get();
		return $items->isEmpty() ? null : $items;		 
	}
}
