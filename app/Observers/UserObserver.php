<?php

namespace App\Observers;
use App\Invite;
use App\User;

class UserObserver
{
    public function created(User $user)
    {
        $invite = Invite::where('email' , '=', $user->email)->first();

        if ($invite) {
            $invite->accept();
        }
    }

}