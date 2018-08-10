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
            'qty' => 'integer|nullable'
        ]);

        $data['user_id'] = Auth::user()->id;

        $item = Item::create($data);

        return redirect('/items/' . $item->hid());
    }

    public function delete($hid) {

        $id = Item::decodeHid($hid);
        $currentItem = ($id) ? Item::find($id) : null;

        if ($currentItem) {
            $currentUser = Auth::user();

            if ($currentItem->user_id == $currentUser->id) {
                $name = $currentItem->name;
                $currentItem->wishlists()->sync(array());
                $result = Item::destroy($id);

                $message = $result ? 'The item "' . $name . '" was deleted.' : 'Something went wrong' ;
            } else {
                $message = 'You do not have permission to delete this item';
            }
        } else {
            $message = 'Item could not be found';
        }

        return redirect('/items')->with('message', $message);
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

        return redirect('/items/' . $item->hid());

        //return redirect()->route('home')->with('success', 'Post has been successfully added!');
    }
}
