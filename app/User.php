<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','gender', 'phone', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    }
    public function classes()
    {
        return $this->belongsToMany(Classes::class, 'user_class', 'user_id', 'class_id');
    }

//    public  function exercises()
//    {
//        $now = Carbon::now();
//        return $this->belongsToMany(Exercise::class,'user_exercises','user_id','exercise_id')->wherePivot('deadline','>=',$now);
//    }

}
