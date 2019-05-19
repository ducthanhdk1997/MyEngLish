<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Exam_Result extends Pivot
{
    //
    protected  $table = 'exam_result';

    protected $fillable = [
        'user_id','scores','exam_id'
    ];

    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function exam(){
        return $this->belongsTo('\App\Exam');
    }
}
