<?php

namespace App\Http\Controllers;

use App\Giver;
use App\User;
use App\Wishlist;
use Auth;
use Illuminate\Http\Request;

class GiverController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($listToken, $giverToken = null)
    {
        if (!$giverToken) {
            return redirect(route('list.view', $listToken));
        }

        $giver = Giver::whereToken($giverToken)->first();
        if (!$giver) {
            return redirect(route('list.view', $listToken));
        }

        $currentList = Wishlist::wherePublicHash($listToken)->first();
        if (!$currentList) {
            return redirect(route('list.view', $listToken));
        }

        $itemsOnList = $currentList->items()->get();
        $ownerUserId = $currentList->user_id;

        $owner = User::whereId($ownerUserId)->first();
        $ownerName = $owner->name;

        $isOwner = ($giver->email == $owner->email);

        return view('list.view', compact('currentList', 'itemsOnList', 'ownerName', 'isOwner', 'giver'));
    }

    public function create(Request $request) {
        $data = $request->validate([
            'email' => 'required|max:255|email',
            'list' => 'required',
            'accepted' => 'required'
        ]);

        $listToken = $data['list'];
        $currentList = Wishlist::wherePublicHash($listToken)->first();

        if (!$currentList) {
            return redirect()->back();
        }

        $ownerUserId = $currentList->user_id;
        $owner = User::whereId($ownerUserId)->first();

        if (!$owner) {
            return redirect()->back()->with('message', 'This list is currently unavailable.');
        }
        if ($owner->email == $data['email']) {
            return redirect()->back()->with('message', 'This is your own list. You can\'t give to yourself.');
        }

        $giver = Giver::whereEmail($data['email'])->first();

        if (!$giver) {
            $giver = Giver::create($data);
        }

        return redirect(route('list.giver', array($listToken, $giver->token)));
    }

}
