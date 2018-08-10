<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Vinkla\Hashids\Facades\Hashids;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'birthday'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() {
        $currentUser = Auth::user();

        return $currentUser->permission == 'admin';
    }

    public function lists()
    {
        return $this->hasMany('App\Wishlist');
    }

    public function items()
    {
        return $this->hasMany('App\Item');
    }

    public function hid() {
        return Hashids::connection('user')->encode($this->id);
    }

    public static function decodeHid($hid) {
        $decoded = $hid ? Hashids::connection('user')->decode($hid) : null;

        return is_array($decoded) && !empty($decoded) ? $decoded[0] : null;
    }
}
