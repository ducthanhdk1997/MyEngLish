<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    //
    protected $table = 'vouchers';

    protected $fillable = [
        'code','value'
    ];
}
