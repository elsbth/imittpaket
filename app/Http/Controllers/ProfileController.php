<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|nullable|string|max:255',
            'birthday' => 'nullable|date_format:Y-m-d',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator, 'store')
                ->withInput();
        }

        $data = $input = $request->all();

        $hid = $data['user_id'];
        $id = User::decodeHid($hid);

        $currentUser = Auth::user();

        if ($validator && $currentUser->id == $id) {

            $currentUser->fill($data);
            $changes = $currentUser->getDirty();


            if ($changes) {
                $currentUser->save();

                $changedFields = array_keys($changes);
                $message = 'Account updated: ' . join(', ', $changedFields);
            } else {
                $message = 'No changes detected.';
            }
        } else {
            $message = 'You are not allowed to edit this account.';
        }

        return redirect(route('profile'))->with('message', $message);

        //TODO: Show error message on proper view instead of just echo and die
        echo 'Doesn\'t validate OR Trying to edit someone else\'s profile.';
        die;
    }
}
