<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_home'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
	];
	
	/**
     * Get the groups for the user.
     */
    public function groups()
    {
        return $this->hasMany('App\Models\Group', 'id_user');
	}
		
	/**
     * Get the groups for the user.
     */
    public function accounts()
    {
        return $this->hasMany('App\Models\Account', 'id_user');
	}
	
	/**
     * Get the cashItems for the user.
     */
    public function cashItems()
    {
        return $this->hasMany('App\Models\Items\CashItem', 'id_user');
	}
		
	/**
     * Get the tasks for the user.
     */
    public function tasks()
    {
        return $this->hasMany('App\Models\Items\Task', 'id_user');
    }
		
	/**
     * Get the timers for the user.
     */
    public function timers()
    {
        return $this->hasMany('App\Models\Items\Timer', 'id_user');
    }
}
