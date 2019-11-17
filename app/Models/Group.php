<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Items\Cash as Cash;

class Group extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_user', 'id_parent', 'name', 'description'
	];

	/**
     * Get the user who owns the group.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id_user');
	}

	/**
     * Get the parent group of a group.
     */
    public function parent()
    {
        return $this->belongsTo('App\Models\Group', 'id_parent');
	}

	/**
     * Get the children groups of a group.
     */
    public function children()
    {
        return $this->hasMany('App\Models\Group', 'id_parent');
	}

	/**
     * Get the associated account of the group.
     */
    public function account()
    {
        return $this->hasOne('App\Models\Account', 'id_parent');
	}
	
	/**
     * Get the items of a group.
     */
    public function items()
    {
        return $this->hasMany('App\Models\Item', 'id_parent');
	}
		
	/**
     * Get the cashItems of a group.
     */
    public function cash()
    {
        return Item::has('cash')->where('id_parent', $this->id)->with('cash')->get();
	}
		
	/**
     * Get the tasks of a group.
     */
    public function tasks()
    {
        return Item::has('task')->where('id_parent', $this->id)->with('task')->get();
	}
		
	/**
     * Get the timers of a group.
     */
    public function timers()
    {
        return Item::has('timer')->where('id_parent', $this->id)->with('timer')->get();
	}
		
	/**
     * Get the bookmarks of a group.
     */
    public function bookmarks()
    {
        return Item::has('bookmark')->where('id_parent', $this->id)->with('bookmark')->get();
	}

	/**
	 * Get an array of the current Group's children - 1st and 2nd degree.
	 * Return Null is no children exist, or an array of Groups who's id_parent is set to the current Group id.
	 * For each of the children groups find any CashItem objects
	 *
	 * @return array $groups
	 */
	public function getChildren()
	{
		if ($this->children()->doesntExist()) {
			return null;
		} else {
			$groups = $this->children()->with('children')->get();
			foreach ($groups as $group) {
				$group->cashTotals = $group->getCashTotals();
			}
			return $groups;
		}
	}

	/**
	 * Recursively get an array of the full hierarchy of the current Group's children.
	 * Return Null is no children exist, or an array of Groups who's id_parent is set to the current Group id.
	 *
	 * @return Group $group
	 */
	public function groupHierarchy()
	{
		if ($this->children()->exists()) {
			$this->children->each(function ($child) {
				$child->groupHierarchy();
			});
		}

		return $this;
	}

	/**
	 * Recursively add up the total expenses and income of the current Group's children hierarchy.
	 * Return an array oan array containing 2 key value pairs for Expenses and Income with their values.
	 *
	 * @param array $total
	 * @return array $total
	 */
	public function getBalance(array $total = ["expense" => 0, "income" => 0])
	{
		$total['expense'] += $this->getCashTotals()['expense'];
		$total['income'] += $this->getCashTotals()['income'];
		if ($this->children) {
			foreach ($this->children as $child) {
				return $child->getBalance($total);
			}
		}
		return $total;
	}

	/**
     * Get an array with the Totals of income and expenses for a given group.
	 * Return Null is no items exist, or an array containing 3 key value pairs for Expenses, Income and Balance with their values.
     *
     * @return array $totals
     */
	public function getCashTotals(){
		if ($this->cashItems){
			$totals = [
				'expense' => $this->cashItems()->where('type', 'expense')->sum('amount'),
				'income' => $this->cashItems()->where('type', 'income')->sum('amount')
			];		
			$totals['balance'] = $totals['income'] - $totals['expense'];

			return $totals;	

		} else {
			return null;
		}				 
	}

	/**
	 * Build the current Group parent objects hierarchy, up to the HOME group.
	 *
	 * @param  array  $groupHierarchy
	 * @return array $groupHierarchy
	 */
	public function buildHierarchy($groupHierarchy = [])
	{
		array_unshift($groupHierarchy, $this);

		if ($this->id_parent == 0) {
			return $groupHierarchy;
		} else {			
			return $this->parent->buildHierarchy($groupHierarchy);
		}
	}
}
