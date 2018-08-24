<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Giver extends Model
{
    protected $fillable = [
        'token',
        'email',
        'accepted'
    ];

    public function hid()
    {
        return Hashids::connection('giver')->encode($this->id);
    }

    public static function decodeHid($hid)
    {
        $decoded = $hid ? Hashids::connection('giver')->decode($hid) : null;

        return is_array($decoded) && !empty($decoded) ? $decoded[0] : null;
    }
}
