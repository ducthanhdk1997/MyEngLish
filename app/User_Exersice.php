<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Exersice extends Model
{
    //
    protected $table = 'user_exercises';
    protected $fillable = ['user_id','exercise_id','total_question','correct_answer','point','new'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class, 'exercise_id', 'id');
    }
}
