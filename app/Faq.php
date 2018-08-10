<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Faq extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'faq';

    protected $fillable = [
        'question',
        'answer',
        'position',
    ];

    public function hid() {
        return Hashids::connection('faq')->encode($this->id);
    }

    public static function decodeHid($hid) {
        $decoded = $hid ? Hashids::connection('faq')->decode($hid) : null;

        return is_array($decoded) && !empty($decoded) ? $decoded[0] : null;
    }
}
