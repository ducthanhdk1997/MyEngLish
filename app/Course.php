<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $table = 'courses';

<<<<<<< HEAD
=======
    public function grade(){
        return $this->belongsTo('App\Grade');
    }
>>>>>>> 4fd72f4b37d2a48731c0a09480284fa90374de8a
}
