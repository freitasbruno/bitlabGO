<?php

namespace App\Models\Items;

use App\Models\Item as Item;

class Task extends Item
{
	protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_parent', 'complete'
	];

	/**
     * Get the user who owns the task.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
	}

	/**
     * Get the parent group of a task.
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Item', 'id_parent');
	}
	
}
