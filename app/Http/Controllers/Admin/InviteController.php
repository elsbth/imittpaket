<?php

namespace App\Http\Controllers\Admin;

use App\Invite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class InviteController extends Controller
{
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

//        TODO: Check if email already exists
//        $existingInvite = Invite::find($data['email'])

        $invite = Invite::create($data);

        if ($invite) {
            $invite->save();
        }

        return redirect(route('admin.invites', $invite->hid()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvitedForm $request, Invite $invite)
    {
        $user = $invite->addNew($request);

        return redirect()->route('account.show', $user);
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