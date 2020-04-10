<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded =[];

    public function order(){
        
        return $this->belongsTo('App\Orders');
    }
}
