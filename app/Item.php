<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
