<?php

namespace App;

use App\MarkedItem;
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

    public function category()
    {
        return $this->belongsTo('App\ItemCategory');
    }

    public function wishlists()
    {
        return $this->belongsToMany('App\Wishlist')->withPivot('position')->withTimestamps();
    }

    public function isAllMarked()
    {
        $itemId = $this->id;
        $marked = MarkedItem::whereItemId($itemId)->get();
        $markedQty = 0;
        $allMarked = false;

        if ($marked->count() > 0) {
            if ($this->qty) {

                foreach ($marked as $id => $mark) {
                    if ($mark->marked_qty) {
                        $markedQty += $mark->marked_qty;
                    }
                }

                $allMarked = ($this->qty > $markedQty) ? $markedQty : true;

            } else if ($marked->count()) {
                $allMarked = true;
            }

        }

        return $allMarked;
    }

    public function getQtyMarkedByGiver($giverId)
    {
        $itemId = $this->id;
        $marked = MarkedItem::where(['item_id' => $itemId, 'giver_id' => $giverId])->first();

        return ($marked) ? $marked->marked_qty : false;
    }

    public function hid() {
        return Hashids::connection('item')->encode($this->id);
    }

    public static function decodeHid($hid) {
        $decoded = $hid ? Hashids::connection('item')->decode($hid) : null;

        return is_array($decoded) && !empty($decoded) ? $decoded[0] : null;
    }
}
