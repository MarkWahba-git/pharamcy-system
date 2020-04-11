<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
   protected $guarded=[];
   
   public function getImageUrl(){
      return asset($this->image);
   }
   public function user(){
      return $this->belongsTo('App\User');
   }
  
}
