<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable=[
        'drug_name',
        'drug_type',
        'drug_unit_price'
    ];
   
}
