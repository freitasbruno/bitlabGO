<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
	use SoftDeletes;
	protected $table = 'items';
	protected $className = 'Item';


	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_user', 'id_parent', 'name', 'description'
	];

	/**
     * The relationships that should always be loaded.
     *
     * @var array
     */
	protected $with = ['group'];
	
	/**
	 * The class names of item types.
	 *
	 * @var array
	 */
	public function getClassName() {		
		return $this->className;
	}
	
	/**
	 * The table names of item types.
	 *
	 * @var array
	 */
	public function getTable()
    {
        return $this->table;
	}	
	/**
     * Get the user who owns the item.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
	}

	/**
     * Get the parent group of a item.
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'id_parent');
	}

	/**
     * Get the children items of a item.
     */
    public function items()
    {
		$items = [
			'bookmarks' => $this->hasMany('App\Models\Items\Bookmark', 'id_parent'),
			'cash' => $this->hasMany('App\Models\Items\Cash', 'id_parent'),
			'tasks' => $this->hasMany('App\Models\Items\Task', 'id_parent'),
			'timers' => $this->hasMany('App\Models\Items\Timer', 'id_parent'),
		];
		return $items;
	}
	
	/**
     * Get the cashItem of a item.
     */
    public function cash()
    {
        return $this->hasOne('App\Models\Items\Cash', 'id_parent');
	}
		
	/**
     * Get the task of a item.
     */
    public function task()
    {
        return $this->hasOne('App\Models\Items\Task', 'id_parent');
	}
		
	/**
     * Get the timer of a item.
     */
    public function timer()
    {
        return $this->hasOne('App\Models\Items\Timer', 'id_parent');
	}
		
	/**
     * Get the bookmark of a item.
     */
    public function bookmark()
    {
        return $this->hasOne('App\Models\Items\Bookmark', 'id_parent');
	}

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
