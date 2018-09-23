<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class ItemCategory extends Model
{
    protected $fillable = [
        'name',
        'icon'
    ];

    public function items()
    {
        return $this->belongsToMany('App\Item');
    }

    public function hid() {
        return Hashids::connection('itemcategory')->encode($this->id);
    }

    public static function decodeHid($hid) {
        $decoded = $hid ? Hashids::connection('itemcategory')->decode($hid) : null;

        return is_array($decoded) && !empty($decoded) ? $decoded[0] : null;
    }

}
