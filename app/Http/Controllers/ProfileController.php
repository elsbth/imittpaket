<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Request;
use App\User;

class ProfileController extends Controller
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
     * Show the user profile with user information.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile', ['currentUser' => Auth::user()]);
    }

    /**
     * Edit form for user data
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('profile.edit', ['currentUser' => Auth::user()]);
    }

    /**
     * Save updated user data
     *
     * @return \Illuminate\Http\Response
     */
    public function store($hid)
    {
        $id = User::decodeHid($hid);

        $currentUser = Auth::user();

        $validates = $this->validate(request(), [
            'name' => 'nullable|string|max:255',
            'birthday' => 'nullable|date_format:Y-m-d',
        ]);

        if ($validates && $currentUser->id == $id) {
            $user = User::whereId($id)->first();

            $newData = [];

            if (!request('name') == '') {
                $newData['name'] = request('name');
            }
            if (!request('birthday') == '') {
                $newData['birthday'] = request('birthday');
            }

            if (!request('password') == '') {
                $newData['password'] = bcrypt(Request::input('password'));
            }

            $user->update($newData);

            return redirect('/profile');

        }

        echo 'Doesn\'t validate OR Trying to edit someone else\'s profile.';
        die;
    }

}
