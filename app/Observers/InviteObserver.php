<?php

namespace App\Observers;
use App\Invite;

class InviteObserver
{
    public function creating(Invite $invite)
    {
        $invite->token = $this->generateToken();
    }

    /**
     * Generate random token, check if unique, if not regenerate.
     *
     * @return string $token
     */
    protected function generateToken()
    {
        $token = str_random(20);
        if (Invite::where('token', $token)->first()) {
            return $this->generateToken();
        }
        return $token;
    }
}