<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarkedItem extends Model
{
    protected $table = 'marked_items';

    protected $fillable = [
        'item_id',
        'user_id',
        'giver_id',
        'marked_qty',
    ];
}
