<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Exercise;
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

    public function checkName($grade_id,$style_id,$nname)
    {
        $nname = str_slug($nname);
        $exercises = Exercise::where('grade_id',$grade_id)
            ->where('style_id',$style_id)
            ->get();
        if($exercises=='')
        {
            return false;
        }

        return false;
    }

}
