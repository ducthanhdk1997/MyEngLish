<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Exersice extends Model
{
    //
    protected $table = 'user_exercises';
    protected $fillable = ['user_id','exercise_id','total_question','correct_answer','point','new'];
}
