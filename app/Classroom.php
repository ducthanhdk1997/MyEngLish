<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    //
    protected $table = 'classrooms';

    protected $fillable = [
        'name'
    ];

    public  function exam()
    {
        return $this->hasMany('App\Exam');
    }

    public  function class_session()
    {
        return $this->hasMany('App\Class_Session');
    }

    public  function schedule_class()
    {
        return $this->hasMany('App\Class_Session');
    }
}
