<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $table = 'exams';

    protected $fillable = [
        'title','start_date','state','classroom_id','coures_id','shift_id'
    ];

    public  function  classroom()
    {
        return $this->belongsto('App\Classroom');
    }

    public  function course()
    {
        return $this->belongsTo('App\Course');
    }

    public  function shift()
    {
        return $this->belongsTo('App\Shift');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_exam', 'exam_id', 'user_id');
    }

    public function examResult()
    {
        return $this->hasMany('App\Exam_Result', 'exam_id');

    }
}
