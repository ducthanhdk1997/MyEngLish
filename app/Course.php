<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $table = 'courses';

    protected $fillable = [
        'name','start_date', 'end_date','describe','price'
    ];

    public function grade(){
        return $this->belongsTo('App\Grade');
    }
}
