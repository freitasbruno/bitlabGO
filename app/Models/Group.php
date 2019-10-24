<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
	 * Check is the Group has any nested group(s).
	 * Return true is it has at least one or false otherwise
	 *
	 * @return bool
	 */
	public function hasChildren()
	{
		$groups = Group::where('id_user', Auth::id())->where('id_parent', $this->id)->first();
		return ($groups ? true : false);
	}

	public function groups()
	{
		$groups = Group::where('id_parent', $this->id)->get();
		return $groups->sortBy('name');
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
		if (!$this->hasChildren()) {
			return null;
		} else {
			$groups = $this->groups();
			foreach ($groups as $group) {
				if ($group->hasChildren()) {
					$group->children = $group->groups();
				} else {
					$group->children = null;
				}
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

		if ($this->hasChildren()) {
			$this->children = Group::where('id_user', Auth::id())->where('id_parent', $this->id)->get();
			$this->children->each(function ($child, $key) {
				$child->groupHierarchy();
			});
		} else {
			$this->children = null;
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
