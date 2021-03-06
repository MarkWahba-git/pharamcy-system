<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{

    protected $guarded=[];


   
    public function getImageUrl(){
        return asset($this->image);
     }
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

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
    public function orders()
    {
        return $this->hasMany('App\Orders');
    }
}
