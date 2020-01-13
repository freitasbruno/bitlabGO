<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

class Timer extends Model
{
	protected $table = 'timers';
	protected $className = 'Timer';

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
	
	public static function getTotals($items) {

		$totals = [
			'time' => 100,
			'type' => 'timers'
		];

		return $totals;
	}
}
