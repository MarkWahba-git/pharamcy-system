<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
<<<<<<< HEAD

class User extends Authenticatable
{
    use Notifiable;
=======
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable  implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

>>>>>>> Dev

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
<<<<<<< HEAD
    protected $fillable = [
        'name', 'email', 'password',
    ];
=======
    protected $guarded = [

    ];
   
>>>>>>> Dev

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
<<<<<<< HEAD
        'password', 'remember_token',
=======
         'remember_token',
>>>>>>> Dev
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
<<<<<<< HEAD
=======
    
    public function getImageUrl(){
        return asset($this->avatar);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
    public function orders()
    {
        return $this->hasMany(Orders::class);
    }
  

>>>>>>> Dev
}
