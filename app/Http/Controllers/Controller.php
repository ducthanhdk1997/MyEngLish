<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Grade;
use App\Style_Exercise;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public  function  __construct()
    {
        View::share('grades',Grade::all());
        View::share('class',Classes::all());
        View::share('style',Style_Exercise::all());
    }

}
