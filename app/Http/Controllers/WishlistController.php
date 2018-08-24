<?php

namespace App\Http\Controllers;

use App\Wishlist;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

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
            'date' => 'date_format:Y-m-d|nullable'
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

    public function edit($hid)
    {
        $id = Wishlist::decodeHid($hid);
        $currentList = ($id) ? Wishlist::find($id) : null;

        $itemsOnList = ($currentList) ? $currentList->items()->get() : null;
        $user = Auth::user();
        $lists = $user->lists;

        return view('list.edit', compact('currentList', 'itemsOnList', 'lists'));
    }


    public function store(Request $request)
    {
        $redirectTo = 'list.edit';

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'description' => 'max:255',
            'date' => 'date_format:Y-m-d|nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'store')
                ->withInput();
        }

        $data = $input = $request->all();

        $hid = $data['list_id'];
        $id = Wishlist::decodeHid($hid);

        $currentList = ($id) ? Wishlist::find($id) : null;

        if ($currentList) {
            $currentUser = Auth::user();

            if ($currentList->user_id == $currentUser->id) {

                $currentList->fill($data);
                $changes = $currentList->getDirty();

                if ($changes) {
                    $currentList->save();

                    $changedFields = array_keys($changes);
                    $message = 'List updated: ' . join(', ', $changedFields);
                    $redirectTo = 'lists';
                } else {
                    $message = 'No changes detected.';
                }
            } else {
                $message = 'You are not allowed to edit this list.';
            }
        } else {
            $message = 'List could not be found.';
        }

        return redirect(route($redirectTo, $currentList->hid()))
            ->with('message', $message);
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
        $currentUser = Auth::user();
        $ownerUserId = ($currentList) ? $currentList->user_id : null;

        $owner = ($currentList) ? User::whereId($ownerUserId)->first() : null;
        $ownerName = ($owner) ? $owner->name : null;
        $isOwner = ($currentUser && $owner) ? $ownerUserId == $currentUser->id : false;

        return view('list.view', compact('currentList', 'itemsOnList', 'ownerName', 'isOwner'));
    }
}
