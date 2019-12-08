<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
	protected $table = 'timers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_parent', 'start', 'stop'
	];

	/**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['item'];

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
    public function item()
    {
        return $this->belongsTo('App\Models\Item', 'id_parent');
	}

}
