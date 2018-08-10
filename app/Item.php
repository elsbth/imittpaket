<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Item extends Model
{

    protected $fillable = [
        'name',
        'description',
        'link',
        'price',
        'qty',
        'user_id'
    ];

    /**
     * Get the user that owns the list.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function wishlists()
    {
        return $this->belongsToMany('App\Wishlist')->withTimestamps();
    }

    public function hid() {
        return Hashids::connection('item')->encode($this->id);
    }

    public static function decodeHid($hid) {
        $decoded = $hid ? Hashids::connection('item')->decode($hid) : null;

        return is_array($decoded) && !empty($decoded) ? $decoded[0] : null;
    }
}
