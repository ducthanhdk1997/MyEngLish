<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Course;
use App\Exam;
use App\Exam_Result;
use App\ResultTest;
use App\Schedule_Class;
use App\Test;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = \Auth::user();
        $courses = $user->courses()->get();
        $scheduleclass = Schedule_Class::all();

        if(!empty($request->filter))
        {
            $filter = $request->filter;
            $classes = $user->classes()->where('course_id','=',$filter)->get();
            return view('pages.classes.index',
                [
                    'classes' => $classes,
                    'filter' => $filter,
                    'courses' => $courses,
                    'scheduleclass' => $scheduleclass
                ]);
        }
        else
        {
            $course = $courses->first();
            $classes = $user->classes()->where('course_id','=',$course->id)->get();
            return view('pages.classes.index',
                [
                    'classes' => $classes,
                    'courses' => $courses,
                    'scheduleclass' => $scheduleclass
                ]);
        }
    }

    public function detail(Classes $class)
    {
        $exam = Exam::query()->where('course_id','=',$class->course_id)->select('id')->get();
        $exam_result = Exam_Result::query()->whereIn('exam_id',$exam)->where('user_id',\Auth::user()->id)->first();

        $test = Test::query()->where('class_id','=',$class->id)->select('id')->get();
        $test_results = ResultTest::query()->whereIn('test_id',$test)->where('user_id',\Auth::user()->id)->get();


        return view('pages.classes.detail',[
            'exam_result' => $exam_result,
            'test_results' => $test_results
        ]);
    }
}
