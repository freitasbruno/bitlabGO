<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
	protected $table = 'bookmarks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url', 'iconUrl'
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
        return $this->belongsTo('App\Models\Group', 'id_parent');
	}
}
