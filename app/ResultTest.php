<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ResultTest extends Pivot
{
    //
    protected $table = 'test_result';

    protected $fillable = [
        'user_id','scores','test_id'
    ];

    public function user(){
        return $this->belongsTo('\App\User');
    }

    public function test(){
        return $this->belongsTo('\App\Test');
    }
}
