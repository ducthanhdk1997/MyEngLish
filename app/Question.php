<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table = 'question';
    protected $fillable = ['answer','part_id', 'name', 'content', 'a', 'b', 'c', 'd', 'point', 'image'];

}
