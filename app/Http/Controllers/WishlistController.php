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
        $this->middleware('auth');
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

        $itemsOnList = ($currentList) ? $currentList->items()->get() : null;

        return view('lists', compact('lists', 'currentList', 'itemsOnList'));
    }

    public function create(Request $request) {
        $data = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        $data['user_id'] = Auth::user()->id;

        $list = Wishlist::create($data);

        return redirect('/lists/' . $list->id);
    }
}
