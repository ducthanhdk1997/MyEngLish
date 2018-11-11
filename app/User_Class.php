<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Class extends Model
{
    //
    protected $table = 'user_class';

    public function user(){
        return $this->belongsTo('\App\User');
    }
}
