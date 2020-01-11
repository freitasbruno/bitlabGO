<?php

namespace App\Models\Items;

use App\Models\Item as Item;

class Task extends Item
{
	protected $table = 'tasks';
	protected $className = 'Task';
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_parent', 'complete'
	];

	/**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['item'];
	
	/**
     * Get the user who owns the resource.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
	}

	/**
     * Get the parent item of a resource.
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'id_parent');
	}
}
