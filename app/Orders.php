<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    
    
    protected $fillable=[
        'user_id',
        'doctor_id',
        'is_insured',
        'status',
        'pharmacy_id',
        'medicine_id',
        'created_at'
    ];
    public function doctor(){
        return $this->belongsTo('App\User');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function drug(){
        return $this->belongsTo('App\Drug');
    }
    public function pharmacy(){
        return $this->belongsTo('App\Pharmacy');
    }
}
