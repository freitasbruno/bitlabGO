<?php

namespace App\Http\Controllers;

use App\Models\Items\Bookmark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$item = new Bookmark;
		$item->id_user = Auth::user()->id;
		$item->id_parent = session('currentGroup')->id ?? 0;
		$item->url = $request->get('url');

		$item->name = $this->findSiteTitle($item->url);

		$item->save();

		return back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Bookmark  $bookmark
	 * @return \Illuminate\Http\Response
	 */
	public function show(Bookmark $bookmark)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Bookmark  $bookmark
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Bookmark $bookmark)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Bookmark  $bookmark
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, int $id)
	{
		$item = Bookmark::find($id);
		$item->url = $request->get('url');
		$item->save();

		$id_parent = session('currentGroup')->id ?? null;
		// load the view and pass the groups
		return redirect('home/' . $id_parent);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Bookmark  $bookmark
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(int $id)
	{
		$item = Task::find($id);
		$item->delete();
		return back();
	}

	private function findSiteTitle(string $url)
	{ 
		$str = file_get_contents($url);
		if(strlen($str)>0){
			$str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
			preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
			return $title[1];
		}
	}
}
