<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_Voucher extends Model
{
    //

    protected $table = 'detail_voucher';

    protected $fillable = [
        'code','value','state','voucher_id'
    ];

    public  function voucher()
    {
        return $this->belongsTo('App\Voucher');
    }
}
