<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule_Class extends Model
{
    //
    protected  $table  = 'schedule_class';

    protected $fillable = [
        'start_date','end_date','weekday' , 'class_id' ,'classrooms' , 'shift_id'
    ];

    public  function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public  function shift()
    {
        return $this->belongsTo('App\Shift');
    }

    public  function class()
    {
        return $this->belongsTo('App\Classes');
    }
}
