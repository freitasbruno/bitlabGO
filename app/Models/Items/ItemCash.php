<?php

namespace App\Models\Items;

use App\Models\Item as Item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
	
		
	private static function getGroupItems($group_id) 
	{
		$items = ItemCash::where('id_parent', $group_id)->get();
		return $items;
	}
}
