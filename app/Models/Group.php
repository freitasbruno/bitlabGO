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
        'id_user', 'name', 'description', 'children', 'cash',
	];
	
		
    /**
     * Get an array of the current Group's children.
     *
     * @param  int  $id
     * @return array $groups
     */
    public function hasChildren()
    {        
        $groups = Group::where('id_user', Auth::id())->where('id_parent', $this->id)->first();
        return ($groups ? true : false);
	}

    /**
     * Get an array of the current Group's children.
     *
     * @param  int  $id
     * @return array $groups
     */
    public function getChildren()
    {        
        $groups = Group::where('id_user', Auth::id())->where('id_parent', $this->id)->get();
        foreach($groups as $group){
			$group -> children = Group::where('id_user', Auth::id())->where('id_parent', $group->id)->get();
			$group -> cash = ItemCash::getGroupItems($group->id);
        }

        return $groups;
	}
	
    /**
     * Get an array of the current Group's children.
     *
     * @param  int  $id
     * @return array $groups
     */
    public function getChildrenHierachy($childrenHierarchy)
    {  
		array_push($childrenHierarchy, $this);
		if ($this->hasChildren()) {
			$groups = Group::where('id_user', Auth::id())->where('id_parent', $this->id)->get();
			foreach ($groups as $group) {
				return getChildrenHierachy($childrenHierarchy);
			}
		}else{
			return $childrenHierarchy;
		}  
	}
	   
    /**
     * Build the hierarchy of Groups based on the current Group.
     *
     * @param  int  $id
     * @return array $groups
     */
    public static function buildHierarchy(Group $group, $groupHierarchy = [])
    {        
        array_unshift($groupHierarchy, $group);

        if ($group->id_parent == 0){
            return $groupHierarchy;
        }else{
			$parent = Group::find($group->id_parent);
            return Group::buildHierarchy($parent, $groupHierarchy);
        }
    }
}
