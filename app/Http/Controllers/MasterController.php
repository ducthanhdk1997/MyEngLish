<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Grade;
use App\Style_Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class MasterController extends Controller
{
    //

    public  function  __construct()
    {
        View::share('grades',Grade::all());
        View::share('class',Classes::all());
        View::share('style',Style_Exercise::all());
        $this->checkLogin();
    }

    public  function checkLogin()
    {
        if(Auth::check())
        {
            view()->share('user',Auth::user());
        }
    }



}
