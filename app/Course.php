<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $table = 'courses';

    public function grade(){
        return $this->belongsTo('App\Grade');
    }
}
