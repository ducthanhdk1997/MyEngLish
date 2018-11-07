<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_Course extends Model
{
    //
    protected $table = 'class_course';
    protected $fillable = ['class_id','course_id'];
}
