<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersManager extends Model
{
    protected $fillable = [
        'name','description'
    ];
}
