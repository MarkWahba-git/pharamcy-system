<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
   protected $fillable=['created_at','is_banned','doctor_name','email','image'];
}
