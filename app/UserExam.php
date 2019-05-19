<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UserExam extends  Pivot
{
    //
    protected $table = 'user_exam';

    protected $fillable = [
        'user_id','exam_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function exam(){
        return $this->belongsTo('App\Exam');
    }
}
