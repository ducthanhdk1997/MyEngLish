<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class User_Course extends Pivot
{
    //
    protected $table = 'user_course';

    protected $fillable = [
        'user_id','state', 'total_amount' , 'voucher_id' , 'course_id'
    ];

    public  function course()
    {
        return $this->belongsTo('App\Course');
    }
}
