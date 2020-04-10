<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];

    public function user(){

        $this->belongsTo(User::class);
    }
}
