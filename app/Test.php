<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    //
    protected $table = 'tests';

    protected $fillable = [
        'title','class_id'
    ];

    public  function class()
    {
        return $this->belongsTo('App\Classes');
    }
}
