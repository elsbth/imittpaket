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
    public function index($hid = null)
    {
        $user = Auth::user();
        $lists = $user->lists;
        $id = Wishlist::decodeHid($hid);

        $currentList = ($id) ? Wishlist::find($id) : null;
        $publicLink = ($currentList) ? $currentList->getPublicLink() : null;

        $itemsOnList = ($currentList) ? $currentList->items()->get() : null;

        return view('lists', compact('lists', 'currentList', 'itemsOnList', 'publicLink'));
    }

    public function create(Request $request) {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:255',
            'date' => 'date_format:Y-m-d'
        ]);

        $data['user_id'] = Auth::user()->id;

        /** @var Wishlist $list */
        $list = Wishlist::create($data);
//        $newList = Wishlist::whereId($list->id)->first();

        if ($list) {
            $list->save();
            $list->addPublicHash($list->id, $list->title);
        }

        return redirect('/lists/' . $list->hid());
    }

    public function delete($hid) {

        $id = Wishlist::decodeHid($hid);
        $currentList = ($id) ? Wishlist::find($id) : null;

        if ($currentList) {
            $currentUser = Auth::user();

            if ($currentList->user_id == $currentUser->id) {
                $title = $currentList->title;
                $currentList->items()->sync(array());
                $result = Wishlist::destroy($id);

                $message = $result ? 'The list "' . $title . '" was deleted.' : 'Something went wrong' ;
            } else {
                $message = 'You do not have permission to delete this list';
            }
        } else {
            $message = 'List could not be found';
        }

        return redirect('/lists/')->with('message', $message);
    }

    public function view($hash) {
        $currentList = Wishlist::wherePublicHash($hash)->first();
        $itemsOnList = ($currentList) ? $currentList->items()->get() : null;

        $owner = ($currentList) ? User::whereId($currentList->user_id)->first() : null;
        $ownerName = ($owner) ? $owner->name : null;

        return view('list.view', compact('currentList', 'itemsOnList', 'ownerName'));
    }
}
