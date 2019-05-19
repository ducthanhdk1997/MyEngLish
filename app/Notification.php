<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $table = 'notifications';

    protected $fillable = [
        'content','title','user_id','state'
    ];

    public  function user()
    {
        return $this->belongsTo('App\User');
    }
}
