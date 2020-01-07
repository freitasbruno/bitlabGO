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
		$items = Item::has('bookmark')
			->where('id_user', Auth::user()->id)
			->where('id_parent', session('currentGroup')->id)
			->with('bookmark')->get();
		
		$returnHTML = view('panels.itemPanel')->with([
			'itemType' => 'bookmark', 
			'title' => 'BOOKMARKS', 
			'items' => $items])
			->render();

		return response()->json(array(
			'success' => true,
			'items' => $items, 
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
		$cardHtml = view('cards.bookmarkCard')->with('item', $bookmark->item)->render();
		$modalHtml = view('cards.bookmarkDetailCard')->with('item', $bookmark->item)->render();
		return response()->json(array(
			'success' => true,
			'item' => $bookmark->item, 
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
	public function update(Request $request, Bookmark $bookmark)
	{		
		$field = $request->get('field');
		$content = $request->get($field);

		if ($field == 'name' || $field == 'description') {
			$bookmark->item->$field = $content;
			$bookmark->item->save();
		} else {
			$bookmark->$field = $content;
			$bookmark->save();
		}

		$modalHtml = view('cards.bookmarkDetailCard')->with('item', $bookmark->item)->render();

		return response()->json(array(
			'success' => true,
			'type' => 'bookmark',
			'bookmark' => $bookmark->toJson(),
			'modalHtml' => $modalHtml
		));
	}

	/**
	 * Remove the specified resource from storage.
	 *
     * @param  int  $id
	 */
	public function destroy(Bookmark $bookmark)
	{
		$bookmark->delete();
		return response()->json(array(
			'success' => true,
			'type' => 'bookmark',
			'bookmark' => $bookmark->toJson()
		));
	}

	/**
     * Get a form to update a specific field.
     *
     */	
    public function getForm(Bookmark $bookmark)
    {
		$field = $_POST['field'];

		if ($field == 'name' || $field == 'description') {
			$html = view('forms.fieldForm')->with(['field' => $field, 'content' => $bookmark->item->$field])->render();
		} else {
			$html = view('forms.fieldForm')->with(['field' => $field, 'content' => $bookmark->$field])->render();
		}
		
		return response()->json(array(
			'success' => true,
			'type' => 'bookmark',
			'field' => $field,
			'html' => $html
		));
	}
			
	/**
     * Move the specified resource to a new group.
     *
     */	
    public function move(Bookmark $bookmark)
    {
		$targetId = $_POST['targetId'];
		$item = $bookmark->item;

		$item->id_parent = $targetId;
		$item->save();

		session(['currentGroup' => $item->group]);

        return response()->json(array(
			'success' => true,
			'bookmark' => $bookmark->toJson()
		));
	}
}
