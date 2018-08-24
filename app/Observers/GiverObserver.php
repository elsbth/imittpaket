<?php

namespace App\Observers;
use App\Giver;

class GiverObserver
{
    public function creating(Giver $giver)
    {
        $giver->token = $this->generateToken();
    }

    /**
     * Generate random token, check if unique, if not regenerate.
     *
     * @return string $token
     */
    protected function generateToken()
    {
        $token = str_random(20);
        if (Giver::where('token', $token)->first()) {
            $this->generateToken();
        }
        return $token;
    }
}