<?php

namespace App\Http\Controllers;

use App\Models\Item;
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
		$bookmarks = Bookmark::where('id_user', Auth::user()->id)
			->with('item')->get();
		
		$returnHTML = view('panels.bookmarksPanel')->with('bookmarks', $bookmarks)->render();
		return response()->json(array(
			'success' => true,
			'items' => $bookmarks->toJson(), 
			'html' => $returnHTML));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$html = view('forms.newItemForm')->with(['itemType' => 'bookmark'])->render();
		return response()->json(array(
			'success' => true,
			'type' => 'bookmark',
			'modalHtml' => $html));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$id_user = Auth::user()->id;
		$currentGroup = session('currentGroup')->id;

		$item = Item::create([
			'id_user' => $id_user,
			'id_parent' => $currentGroup,
			'name' => 'Title not found'
		]);
		
		$bookmark = Bookmark::create([
			'id_user' => $id_user,
			'id_parent' => $item->id,
			'url' => $request->get('url')
		]);

		$item->name = $bookmark->findSiteTitle();
		$item->save();

        return response()->json($bookmark);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Bookmark  $bookmark
	 * @return \Illuminate\Http\Response
	 */
	public function show(Bookmark $bookmark)
	{
		$cardHtml = view('cards.bookmarkCard')->with('bookmark', $bookmark)->render();
		$modalHtml = view('cards.bookmarkDetailCard')->with('bookmark', $bookmark)->render();
		return response()->json(array(
			'success' => true,
			'item' => $bookmark->toJson(), 
			'cardHtml' => $cardHtml,
			'modalHtml' => $modalHtml
		));
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
     * @param  int  $id
	 */
	public function destroy(int $id)
	{
		$bookmark = Bookmark::find($id);
		$item = Item::find($bookmark->id_parent);
		$bookmark->delete();
		$item->delete();
		return back();
	}
}
