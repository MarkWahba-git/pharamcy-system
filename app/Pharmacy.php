<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{

    protected $fillable = [
        'name',
        'street_name',
        'building_number',
        'owner_id',
        'area_id',
    ];

    // public function user()
    // {
    //     return $this->belongsTo('App\User');
    // }

    // public function area()
    // {
    //     return $this->belongsTo('App\Area');
    // }
}
