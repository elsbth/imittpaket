<?php

namespace App\Http\Controllers;

use App\Wishlist;
use App\User;
use Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['view']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $user = Auth::user();
        $lists = $user->lists;

        $currentList = ($id) ? Wishlist::find($id) : null;
        $publicLink = ($currentList) ? $currentList->getPublicLink() : null;

        $itemsOnList = ($currentList) ? $currentList->items()->get() : null;

        return view('lists', compact('lists', 'currentList', 'itemsOnList', 'publicLink'));
    }

    public function create(Request $request) {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        $data['user_id'] = Auth::user()->id;

        $list = Wishlist::create($data);
//        $newList = Wishlist::whereId($list->id)->first();

        if ($list) {
            $list->addPublicHash($list->id, $list->title);
        }

        return redirect('/lists/' . $list->id);
    }

    public function view($hash) {
        $currentList = Wishlist::wherePublicHash($hash)->first();
        $itemsOnList = ($currentList) ? $currentList->items()->get() : null;

        $owner = ($currentList) ? User::whereId($currentList->user_id)->first() : null;
        $ownerName = ($owner) ? $owner->name : null;

        return view('list.view', compact('currentList', 'itemsOnList', 'ownerName'));
    }
}
