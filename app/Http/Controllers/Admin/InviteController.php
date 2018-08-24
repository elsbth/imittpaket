<?php

namespace App\Http\Controllers\Admin;

use App\Invite;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class InviteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($hid = null)
    {
        $id = Invite::decodeHid($hid);
        $currentInvite = ($id) ? Invite::find($id) : null;
        $invites = Invite::all();

        return view('admin/invites', compact('invites', 'currentInvite'));
    }


    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
        ]);

        $existingInvite = Invite::whereEmail($data['email'])->first();
        $existingUser = User::whereEmail($data['email'])->first();

        if ($existingInvite || $existingUser) {
            $existing = [];
            if ($existingInvite) {
                $existing[] = 'Invite';
            }
            if ($existingUser) {
                $existing[] = 'User';
            }

            $msg = join(' and ', $existing) . ' with that email address already exist.';

            return redirect()->back()->with('message', $msg);
        }

        $invite = Invite::create($data);

        return redirect(route('admin.invites', $invite->hid()));
    }

    public function delete($hid) {

        $id = Invite::decodeHid($hid);
        $currentInvite = ($id) ? Invite::find($id) : null;

        if ($currentInvite) {
            $email = $currentInvite->email;
            $result = $currentInvite->delete();

            $message = $result ? 'The invite for "' . $email . '" was deleted.' : 'Something went wrong' ;
        } else {
            $message = 'Invite could not be found';
        }

        return redirect(route('admin.invites.create'))->with('message', $message);
    }
}