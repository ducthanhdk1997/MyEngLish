<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $table = 'class';

    public function grade()
    {
        return $this->belongsTo('\App\Grade');
    }
    public function students()
    {
        return $this->belongsToMany(User::class, 'user_class', 'class_id', 'user_id');
    }
}
