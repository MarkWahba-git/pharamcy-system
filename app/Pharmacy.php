<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{

    protected $fillable = [
        'name',
        'street_name',
        'building_number',
        'owner_nat_id',
        'area_id',
        'priority_area_id',
        'created_at'
    ];

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
}
