<?php

namespace App\Http\Controllers\Admin;

use App\ChangeClassSession;
use App\Class_Session;
use App\Classes;
use App\Exam;
use App\Note;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mockery\Matcher\Not;

class HomeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $date = Carbon::now();
        $now = $date->toDateString();
        $nowExams = Exam::query()->where('state','=',0)->where('start_date','=',$now)->get();

        $missExams = Exam::query()->where('state','=',0)->where('start_date','<',$now)->get();
        $missClass_sessions = Class_Session::query()->where('state','=',0)->where('start_date','<',$now)->get();

        $change_class_sessions = ChangeClassSession::query()->where('state','=',0)->get();

        $class_sessions = Class_Session::query()->where('state','=',0)->where('start_date','=',$now)->get();

        $classes = Classes::query()->where('state','=', 0)->get();

        $end_class = [];
        foreach ($classes as $class)
        {
            $sc = $class->class_session()->where('state','=',0)->count();
            if($sc == 0)
            {
                $end_class[] = [
                   'id' => $class->id
                ];
            }
        }

        $end_classes = Classes::query()->whereIn('id',$end_class)->get();
        return view('admin.homes.index',
            [
                'nowExams' => $nowExams,
                'class_sessions' => $class_sessions,
                'change_class_sessions' => $change_class_sessions,
                'missExams' => $missExams,
                'missClass_sessions' => $missClass_sessions,
                'end_classes' => $end_classes
            ]);
    }


}
