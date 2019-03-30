<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name', 'teacher_id', 'course_id'
    ];


    public function students()
    {
        return $this->belongsToMany(User::class, 'user_class', 'class_id', 'user_id');
    }

    public  function course()
    {
        return $this->belongsTo('App\Course');
    }
    public  function teacher()
    {
        return $this->belongsTo('App\User','teacher_id');
    }

}
