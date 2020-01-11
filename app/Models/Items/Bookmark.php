<?php

namespace App\Models\Items;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
	protected $table = 'bookmarks';	
	protected $className = 'Bookmark';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user', 'id_parent', 'url', 'iconUrl'
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

	public function findSiteTitle()
	{ 
		$str = file_get_contents($this->url);
		if(strlen($str)>0){
			$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
			preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
			return $title[1];
		}
	}
}
