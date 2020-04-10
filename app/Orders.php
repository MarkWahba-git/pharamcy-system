<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    
    
    
    protected $fillable = [
       
        'pharmacy_id',
        'doctor_id',
        'user_id',
        'status',
        'is_insured',
        'created_at'
    ];

    public function doctor(){
        return $this->hasOne('App\Doctor','id','doctor_id');
    }
   
}
