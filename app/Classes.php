<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'class';

    public function grade(){
        return $this->belongsTo('\App\Grade');
    }
}
