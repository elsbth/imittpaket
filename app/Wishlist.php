<?php

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'date',
        'public_hash'
    ];

    /**
     * Get the user that owns the list.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item')->withPivot('position')->withTimestamps();
    }

    static function generatePublicHash($listId, $title)
    {
        $paddedId = str_pad($listId, 10, '0', STR_PAD_LEFT);
        $salt = config('imittpaket.salt_wishlist');

        $hash = md5($salt . $title . $paddedId);

        return $hash;
    }

    function addPublicHash($id, $title) {
        $data['public_hash'] = $this->generatePublicHash($id, $title);
        $this->update($data);
    }

    public function getPublicLink() {
        $hash = $this->public_hash;

        if (!$hash) {
            $this->addPublicHash($this->id, $this->title);
            $hash = $this->public_hash;
        }

        return ($hash) ? route('list.view', [$hash]) : null;
    }

    public function hid() {
        return Hashids::connection('wishlist')->encode($this->id);
    }

    public static function decodeHid($hid) {
        $decoded = $hid ? Hashids::connection('wishlist')->decode($hid) : null;

        return is_array($decoded) && !empty($decoded) ? $decoded[0] : null;
    }
}
