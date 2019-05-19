<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeClassSession extends Model
{
    //
    protected $table = 'change_class_session';

    protected $fillable = [
        'start_date', 'shift_id','state','classroom_id','class_session_id','reason'
    ];

    public  function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }

    public  function shift()
    {
        return $this->belongsTo('App\Shift');
    }

    public  function user()
    {
        return $this->belongsTo('App\User');
    }

    public  function class_session()
    {
        return $this->belongsTo('App\Class_Session');
    }
}
