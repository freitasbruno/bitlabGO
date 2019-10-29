<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Items\ItemCash as ItemCash;

class Group extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'id_user', 'name', 'description'
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
	 * Get an array of the current Group's children - 1st and 2nd degree.
	 * Return Null is no children exist, or an array of Groups who's id_parent is set to the current Group id.
	 * For each of the children groups find any ItemCash objects
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
				$group->cashItems = ItemCash::getItems($group->id);
				$group->cashGroupTotals = ItemCash::getGroupTotals($group->id);
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

	public function getBalance(array $total = ["expense" => 0, "income" => 0])
	{
		$total['expense'] += ItemCash::getGroupTotals($this->id)['expense'];
		$total['income'] += ItemCash::getGroupTotals($this->id)['income'];
		if ($this->children) {
			foreach ($this->children as $child) {
				return $child->getBalance($total);
			}
		}
		return $total;
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
			$parent = Group::find($this->id_parent);
			return $parent->buildHierarchy($groupHierarchy);
		}
	}

	/**
	 * Check is the Group has any nested cashItem(s).
	 * Return true is it has at least one or false otherwise
	 *
	 * @return bool
	 */
	public function hasCashItems()
	{
		$items = ItemCash::where('id_user', Auth::id())->where('id_parent', $this->id)->first();
		return ($items ? 'true' : 'false');
	}
}
