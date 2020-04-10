<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{

    protected $guarded=[];


   
    public function getImageUrl(){
        return asset($this->image);
     }
}
