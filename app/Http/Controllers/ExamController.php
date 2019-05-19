<?php

namespace App\Http\Controllers;

use App\Course;
use App\Exam;
use App\User;
use App\User_Course;
use App\UserExam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock;

class ExamController extends Controller
{
    //

    public  function index(Request $request)
    {
        $user = \Auth::user();
        if(!empty($request->filter)){
            $filter = $request->filter;
            if($filter == -1)
            {
                $exams = $user->exams()->paginate(10);
            }
            else
            {
                if($filter==1)
                {
                    $exams = $user->exams()->where('state','=',0)->paginate(10);
                }
                else
                {
                    if($filter == 2)
                    {
                        $exams = $user->exams()->where('state','=',1)->paginate(10);
                    }
                    else
                    {
                        $exams = $user->exams()->paginate(10);
                        return view('pages.exams.index',['exams'=>$exams]);
                    }
                }

            }
            return view('pages.exams.index',['exams' => $exams,'filter' => $filter]);
        }
        else
        {
            $exams = $user->exams()->paginate(10);
            return view('pages.exams.index',['exams'=>$exams]);
        }

    }



    public  function create(Request $request)
    {
        $user = \Auth::user();
        $date = Carbon::now();
        $now = $date->toDateString();
        $courses  = $user->courses()->get();
        if(!empty($request->filter)){
            $filter = $request->filter;
            $exams = Exam::query()->where('course_id',$filter)
                ->where('deadline','>=',$now)
                ->where('state',0)
                ->get();
            $hasExams = $user->exams()->where('course_id','=',$filter)->get()->first();
            return view('pages.exams.create',
                [
                    'exams' => $exams,
                    'courses' => $courses,
                    'filter' => $filter,
                    'hasExams' => $hasExams
                ]);
        }
        else
        {

            $course = $user->courses()->get()->first();
            $exams = Exam::query()->where('course_id',$course->id)
                ->where('deadline','>=',$now)
                ->where('state',0)
                ->get();

            $hasExams = $user->exams()->where('course_id','=',$course->id)->get()->first();


            return view('pages.exams.create',
                [
                    'exams' => $exams,
                    'courses' => $courses,
                    'hasExams' => $hasExams
                ]);
        }
    }

    public  function stote(Request $request)
    {
        $user = \Auth::user();
        $exam_id = $request->exam;
        $course_id = Exam::query()->where('id',$exam_id)->select('course_id')->first();
        $course = Course::find($course_id)->first();
        $exams = $user->exams()->get();
        foreach ($exams as $exam)
        {
            if($exam->course_id == $course->id)
            {
                flash()->error('Bạn đã đăng ký lịch thi trong khóa học này trước đó');
                return redirect()->back();
            }
        }

        $user_exam = new UserExam();
        $user_exam->user_id =  $user->id;
        $user_exam->exam_id =   $exam_id;

        if($user_exam->save())
        {
            flash()->success('Đăng ký thành công!');
            return redirect()->back();
        }
        else
        {
            flash()->success('Đăng ký không thành công!');
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $user = \Auth::user();
        $hasExam = $request->hasExam;
        if(UserExam::query()->where('user_id',$user->id)->where('exam_id',$hasExam)->delete())
        {
            flash()->success('Hủy thành công!');
            return redirect()->back();
        }
        else
        {
            flash()->success('Hủy không thành công!');
            return redirect()->back();
        }
    }
}
