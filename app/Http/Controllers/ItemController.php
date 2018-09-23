<?php

namespace App\Http\Controllers;

use App\Item;
use App\ItemCategory;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

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
        $categories = ItemCategory::getAll();

        return view('items', compact('items', 'currentItem', 'lists', 'itemListIds', 'categories'));
    }

    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'description' => 'max:255',
            'link' => 'url|max:400|nullable',
            'price' => 'max:50',
            'qty' => 'integer|nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        $data['user_id'] = Auth::user()->id;
        $categoryHid = $data['category'];
        $data['category_id'] = ItemCategory::decodeHid($categoryHid);

        $item = Item::create($data);

        return redirect(route('item.edit', $item->hid()));
    }

    public function edit($hid)
    {
        $currentUser = Auth::user();
        $id = Item::decodeHid($hid);
        $currentItem = ($id) ? Item::find($id) : null;

        if ($currentUser->id != $currentItem->user_id) {
            return redirect(route('home'));
        }

        $items = $currentUser->items;
        $lists = $currentUser->lists;
        $categories = ItemCategory::getAll();

        $currentItemOnLists = ($currentItem) ? $currentItem->wishlists()->get(['wishlist_id'])->toArray() : null;
        $itemListIds = ($currentItemOnLists) ? array_unique(array_column($currentItemOnLists, 'wishlist_id')) : null;

        return view('item.edit', compact('items', 'currentItem', 'lists', 'itemListIds', 'categories'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'name' => 'required|max:255',
            'description' => 'max:255',
            'link' => 'url|max:400|nullable',
            'price' => 'max:50',
            'qty' => 'integer|nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'store')
                ->withInput();
        }

        $data = $input = $request->all();

        $hid = $data['item_id'];
        $id = Item::decodeHid($hid);

        $categoryHid = $data['category'];
        $data['category_id'] = ItemCategory::decodeHid($categoryHid);

        $currentItem = ($id) ? Item::find($id) : null;

        if ($currentItem) {
            $currentUser = Auth::user();

            if ($currentItem->user_id == $currentUser->id) {

                $currentItem->fill($data);
                $changes = $currentItem->getDirty();

                if ($changes) {
                    $currentItem->save();

                    $changedFields = array_keys($changes);
                    $message = 'Item updated: ' . join(', ', $changedFields);
                } else {
                    $message = 'No changes detected.';
                }
            } else {
                $message = 'You are not allowed to edit this item.';
            }
        } else {
            $message = 'Item could not be found.';
        }

        return redirect(route('item.edit', $currentItem->hid()))
            ->with('message', $message);
    }

    public function delete($hid)
    {

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

    public function addToList(Request $request)
    {
        $data = $request->validate([
            'item_id' => 'required',
            'wishlist_id' => 'nullable',
        ]);

        $message = '';

        $itemHid = $data['item_id'];
        $itemId = Item::decodeHid($itemHid);

        $item = Item::find($itemId);

        $wishlistIds = (isset($data['wishlist_id'])) ? $data['wishlist_id'] : array();

        //TODO: Mask the wishlist ids to not use the db id
        $result = $item->wishlists()->sync($wishlistIds);
        $addedCount = count($result['attached']);
        $removedCount = count($result['detached']);

        if ($addedCount) {
            $wording = ($addedCount > 1) ? 'lists' : 'list';
            $message .= 'Added to ' . $addedCount . ' ' . $wording . '. ';
        }
        if ($removedCount) {
            $wording = ($removedCount > 1) ? 'lists' : 'list';
            $message .= 'Removed from ' . $removedCount . ' ' . $wording . '. ';
        }

        return redirect(route('item.edit', $item->hid()))
            ->with('message', $message)
            ->withErrors([], 'addToList');
    }
}
