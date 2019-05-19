<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    //
    protected $table = 'shifts';
    protected $fillable = [
        'name','start_time', 'end_time'
    ];


}
