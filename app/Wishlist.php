<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{

    protected $fillable = [
        'title',
        'description',
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
