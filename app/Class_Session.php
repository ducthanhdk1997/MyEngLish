<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_Session extends Model
{
    //
    protected $table = 'class_session';

    protected $fillable = [
        'start_date', 'shift_id','state','class_id','classroom_id'
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

    public  function Schedule()
    {
        return $this->belongsTo('App\Schedule_Class');
    }
}
