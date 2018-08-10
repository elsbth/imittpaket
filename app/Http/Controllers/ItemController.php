<?php

namespace App\Http\Controllers;

use App\Item;
use Auth;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hid = null)
    {
        $user = Auth::user();
        $items = $user->items;
        $lists = $user->lists;

        $id = Item::decodeHid($hid);

        $currentItem = ($id) ? Item::find($id) : null;
        $currentItemOnLists = ($currentItem) ? $currentItem->wishlists()->get(['wishlist_id'])->toArray() : null;
        $itemListIds = ($currentItemOnLists) ? array_unique(array_column($currentItemOnLists, 'wishlist_id')) : null;

        return view('items', compact('items', 'currentItem', 'lists', 'itemListIds'));
    }

    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'max:255',
            'link' => 'max:255',
            'price' => 'max:50',
            'qty' => 'integer'
        ]);

        $data['user_id'] = Auth::user()->id;

        $item = Item::create($data);

        return redirect('/items/' . $item->id);
    }

    public function addToList(Request $request) {
        $data = $request->validate([
            'item_id' => 'required',
            'wishlist_id' => 'required',
        ]);

        $itemId = $data['item_id'];

        $item = Item::find($itemId);

        $lists = $item->wishlists()->get(['wishlist_id'])->toArray();

        //TODO: Mask the wishlist ids to not use the db id
        $item->wishlists()->sync($data['wishlist_id']);

        return redirect('/items/' . $item->id);

        //return redirect()->route('home')->with('success', 'Post has been successfully added!');
    }
}
