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
    public function index($id = null)
    {
        $user = Auth::user();
        $items = $user->items;

        $currentItem = ($id) ? Item::find($id) : null;

        return view('items', compact('items', 'currentItem'));
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
}
