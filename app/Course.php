<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $table = 'courses';

    protected $fillable = [
        'name','start_date', 'end_date','describe','price'
    ];

    public function classes()
    {
        return $this->hasMany('App\Classes');
    }

    public  function user_course()
    {
        return $this->hasMany('App\User_Course');
    }
}
