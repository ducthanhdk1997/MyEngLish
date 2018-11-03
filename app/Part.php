<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    //
    protected $table = 'parts';
    protected $fillable = ['name', 'num_question','exercise_id'];

}
