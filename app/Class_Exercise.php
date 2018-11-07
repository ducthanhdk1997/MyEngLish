<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_Exercise extends Model
{
    //
    protected $table = 'class_exercises';
    protected  $fillable = ['class_id','exercise_id','deadline'];
}
