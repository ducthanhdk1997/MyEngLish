<?php

namespace App\Http\Controllers\Admin;

use App\Class_Session;
use App\Classes;
use App\Classroom;
use App\Course;
use App\Exam;
use App\Exam_Result;
use App\Http\Requests\Admin\ExamPreviewRequest;
use App\Http\Requests\Admin\ExamStoreRequest;
use App\Http\Requests\Admin\ExamUpdateRequest;
use App\Imports\ImportResultTest;
use App\ResultTest;
use App\Shift;
use App\User;
use App\User_Class;
use App\UserExam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use phpDocumentor\Reflection\DocBlock;

class ExamController extends Controller
{
    //

    public  function  index(Request $request)
    {
        if(!empty($request->filter)){
            $filter = $request->filter;
            if($filter == -1)
            {
                $exams = Exam::query()->paginate(10);
            }
            else
            {
                if($filter==1)
                {
                    $exams = Exam::query()->where('state',0)->paginate(10);
                }
                else
                {
                    if($filter == 2)
                    {
                        $exams = Exam::query()->where('state',1)->paginate(10);
                    }
                    else
                    {
                        $date = Carbon::now();
                        $now = $date->toDateString();
                        $exams = Exam::query()->where('start_date','=',$now)->paginate(10);
                    }
                }
            }
            return view('admin.exams.index',['exams'=>$exams, 'filter'=>$filter]);
        }
        else
        {
            $exams = Exam::query()->paginate(10);
            return view('admin.exams.index',['exams'=>$exams]);
        }


    }

    public  function show(Exam $exam)
    {
        $userExams = UserExam::query()->where('exam_id','=', $exam->id)->paginate(30);
        return view('admin.exams.detail',
            [
                'exam' => $exam,
                'userExams' => $userExams
            ]);
    }

    public  function edit(Exam $exam)
    {
        $today = Carbon::now();
        $day = $today->toDateString();
        $time = $today->toTimeString();


        if($exam->state !=1)
        {
            $shift = Shift::all();
            $classrooms = Classroom::all();
            $courses = Course::all();
            return view('admin.exams.edit',['exam'=>$exam,
                'shifts' => $shift,
                'classrooms' => $classrooms,
                'courses' => $courses,
                'exam' => $exam,
                'day' => $day,
                'time'=> $time]);
        }
        return redirect()->back();


    }

    public  function updateState(Exam $exam)
    {
        $today = Carbon::now();
        $day = $today->toDateTimeString();
        $comp = $exam->start_date.' '.$exam->shift->start_time;
        if (strtotime($day) >= strtotime($comp)) {
            $exam->state = 1;
            $exam->save();
            flash()->success('Thay đổi thành công!');
            return redirect()->back();
        } else {
            flash()->error('Lịch thi chưa kết thúc !');
            return redirect()->back();
        }


    }

    public  function  update(ExamUpdateRequest $request ,Exam $exam)
    {
        $today = Carbon::now();
        $day = $today->toDateString();
        $time = $today->toTimeString();


        $exam->title = $request->title;
        $exam->start_date = $request->start_date;
        $exam->shift_id = $request->shift_id;
        $exam->course_id = $request->course_id;
        $course = Course::find($request->course_id);
        if($course !='')
        {
            if(strtotime($day)>= strtotime($course->start_date))
            {
                flash()->error('Không thể tạo lịch thi cho khóa học này!');
                return redirect()->back();
            }

            if(strtotime($request->start_date) >= strtotime($course->start_date))
            {
                flash()->error('Ngày thi phải trước ngày khóa học bắt đầu!');
                return redirect()->back();
            }
        }

        $exam->classroom_id = $request->classroom_id;
        $exam->deadline = $request->deadline;
        if (strtotime($day) >= strtotime($exam->start_date) && strtotime($time) >= strtotime($exam->shift->end_time)) {
            $exam->state = $request->state ;
        }
        else
        {
            $exam->state = 0;
        }
        if ($exam->save()){
            flash()->success('Thay đổi thành công');
            return redirect()->route('admin.exam.index');
        }
        else{
            flash()->error('Thay đổi thất bại');
            return redirect()->route('admin.exam.index');
        }

    }

    public  function create(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $shift = Shift::all();
        $classrooms = Classroom::all();
        $courses = Course::query()->where('start_date','>=', $today)->get();

        if(!empty($request->course)){
            $course = $request->course;
            $course = Course::find($course);
            return view('admin.exams.create',[
                'shifts' => $shift,
                'classrooms' => $classrooms,
                'cors' => $courses,
                'day' => $today,
                'course' => $course
            ]);

        }
        else
        {
            $course = $courses->first();
            return view('admin.exams.create',[
                'shifts' => $shift,
                'classrooms' => $classrooms,
                'cors' => $courses,
                'day' => $today,
                'course' => $course
            ]);
        }

    }

    public  function store(ExamStoreRequest $request, Exam $exam)
    {
        $today = Carbon::now();
        $day = $today->toDateString();

        $start_date = $request->start_date;
        $shift = $request->shift_id;
        $classroom = $request->classroom_id;

        if($shift == 6)
        {
            $shift_id = [1,2];
        }
        else
        {
            if($shift == 7)
            {
                $shift_id = [3,4];
            }
            else
            {
                $shift_id = [$shift];
            }
        }
        $ex = Exam::query()
            ->where('start_date','=',$start_date)
            ->where('state','=',0)
            ->where('classroom_id','=',$classroom)
            ->whereIn('shift_id',$shift_id)
            ->count();

        $class_ss = Class_Session::query()
            ->where('start_date','=',$start_date)
            ->where('state','=',0)
            ->where('classroom_id','=',$classroom)
            ->whereIn('shift_id',$shift_id)
            ->count();
        if($ex !=0 || $class_ss !=0)
        {
            flash()->error('Dữ liệu đã lỗi thời');
            return redirect()->back();
        }

        $exam->title = $request->title;
        $exam->start_date = $request->start_date;
        $exam->shift_id = $request->shift_id;
        $exam->course_id = $request->course;
        $exam->classroom_id = $request->classroom_id;
        $exam->deadline = $request->deadline;
        $exam->state = 0;
        $course = Course::find($request->course);
        if($course !='')
        {
            if(strtotime($day)>= strtotime($course->start_date))
            {
                flash()->error('Không thể tạo lịch thi cho khóa học này!');
                return redirect()->back();
            }

            if(strtotime($request->start_date) >= strtotime($course->start_date))
            {
                flash()->error('Ngày thi phải trước ngày khóa học bắt đầu!');
                return redirect()->back();
            }
        }
        else
        {
            flash()->error('Khóa học không tồn tại!');
            return redirect()->back();
        }
        if ($exam->save()){
            flash()->success('Thêm thành công');
            return redirect()->route('admin.exam.index');
        }
        else{
            flash()->error('Thêm thất bại');
            return redirect()->back();
        }

    }

    public function arrange(Request $request)
    {
        $courses = Course::all();
        if(!empty($request->filCourse)){
            $filCourse = $request->filCourse;
            $exams = Exam::query()->where('course_id','=',$filCourse)->select('id')->get();
            $classes = Classes::query()->where('course_id',$filCourse)->get();

            $class_id =  Classes::query()->where('course_id',$filCourse)->select('id')->get();

            $users = User_Class::query()->whereIn('class_id',$class_id)->select('user_id')->get();

            $examResults = Exam_Result::query()->whereIn('exam_id',$exams)
                ->whereNotIn('user_id',$users)->get();
            return view('admin.exams.arrange',
                [
                    'filCourse' => $filCourse,
                    'courses' => $courses,
                    'examResults' => $examResults,
                    'classes' => $classes

                ]);

        }
        else
        {
            $course = $courses->first();
            $classes = Classes::query()->where('course_id',$course->id)->get();

            $class_id =  Classes::query()->where('course_id',$course->id)->select('id')->get();

            $users = User_Class::query()->whereIn('class_id',$class_id)->select('user_id')->get();

            $exams = Exam::query()->where('course_id','=',$course->id)->select('id')->get();
            $examResults = Exam_Result::query()
                ->whereIn('exam_id',$exams)
                ->whereNotIn('user_id',$users)
                ->get();

            return view('admin.exams.arrange',
                [
                    'courses' => $courses,
                    'examResults' => $examResults,
                    'classes' => $classes
                ]);
        }
    }

    public function arrangeByCourse(Request $request)
    {
        $courses = Course::all();
        $filCourse = $request->filCourse;
        $exams = Exam::query()->where('course_id','=',$filCourse)->select('id')->get();
        $classes = Classes::query()->where('course_id',$filCourse)->get();

        $class_id =  Classes::query()->where('course_id',$filCourse)->select('id')->get();

        $users = User_Class::query()->whereIn('class_id',$class_id)->select('user_id')->get();

        $examResults = Exam_Result::query()->whereIn('exam_id',$exams)
            ->whereNotIn('user_id',$users)->get();
        return view('admin.exams.arrange',
            [
                'filCourse' => $filCourse,
                'courses' => $courses,
                'examResults' => $examResults,
                'classes' => $classes

            ]);



    }


    public  function result(Request $request)
    {
        $courses = Course::all();
        if(!empty($request->filCourse)){
            $filCourse = $request->filCourse;
            $exams = Exam::query()->where('course_id','=',$filCourse)->get();
            $classes = Classes::query()->where('course_id',$filCourse)->get();
            $examResults = Exam_Result::query()->where('exam_id','=',$exams->first()->id)->paginate(30);
            return view('admin.exams.result',
                [
                    'exams' => $exams,
                    'filCourse' => $filCourse,
                    'courses' => $courses,
                    'examResults' => $examResults,
                    'classes' => $classes

                ]);

        }
        else
        {
            $course = $courses->first();
            $exams = Exam::query()->where('course_id','=',$course->id)->get();
            $classes = Classes::query()->where('course_id',$course->id)->get();

            $examResults = Exam_Result::query()->where('exam_id','=',$exams->first()->id)->paginate(30);
            return view('admin.exams.result',
                [
                    'exams' => $exams,
                    'courses' => $courses,
                    'examResults' => $examResults,
                    'classes' => $classes
                ]);
        }
    }

    public  function showResult(Request $request)
    {
        $courses = Course::all();
        $filCourse = $request->course;
        $filExam = $request->exam;
        $exams = Exam::query()->where('course_id','=',$filCourse)->get();
        $examResults = Exam_Result::query()->where('exam_id','=',$filExam)->paginate(30);
        return view('admin.exams.result',
            [
                'exams' => $exams,
                'filCourse' => $filCourse,
                'filExam' => $filExam,
                'courses' => $courses,
                'examResults' => $examResults

            ]);
    }



    public  function  createResult(Request $request)
    {
        $courses = Course::all();
        if(!empty($request->filter)){
            $filter = $request->filter;

            $exams = Exam::query()->where('course_id','=',$filter)->get();

            return view('admin.exams.create_result',
                [
                    'exams' => $exams,
                    'filter' => $filter,
                    'courses' => $courses
                ]);
        }
        else
        {
            $course = $courses->first();
            $exams = Exam::query()->where('course_id','=',$course->id)->get();

            return view('admin.exams.create_result',
                [
                    'exams' => $exams,
                    'courses' => $courses
                ]);
        }
    }

    public  function storeResult(Request $request)
    {

        if($request->hasFile('file'))
        {
            $file = $request->file;
            $exam_id = $request->exam;

            $exam_results =Excel::load($request->file('file'), function($reader) {
            })->get()->toArray();
            if(!empty($exam_results))
            {
                $insert = [];


                foreach ($exam_results as $exam_result)
                {
                    $student_id = trim($exam_result['user_id']);
                    $fullname = trim($exam_result['username']);
                    $score = trim($exam_result['score']);

                    if ($student_id== '') {
                        flash()->error('Một số cột trong bảng sai cú pháp!');
                        return redirect()->back();

                    }
                    if ($score== '') {
                        flash()->error('Một số cột trong bảng sai cú pháp!');
                        return redirect()->back();
                    }

                    if (Exam_Result::query()
                            ->where('user_id','=',$student_id)
                            ->where('exam_id','=',$exam_id)
                        ->exists())
                    {
                        Exam_Result::query()
                            ->where('user_id','=',$student_id)
                            ->where('exam_id','=',$exam_id)
                            ->update(['score' => $score]);
                        continue;
                    }

                    $insert[] = [
                                    'user_id' =>$student_id,
                                    'exam_id' => $exam_id,
                                    'score' => $score
                                ];
                }

                Exam_Result::query()->insert($insert);
                flash()->success('Cập nhật điểm thành công!');
                return redirect()->back();
            }
            else
            {
                flash()->error('Không có dữ liệu trong file!');
                return redirect()->back();
            }
        }
        else
        {
            flash()->error('File rỗng!');
            return redirect()->back();
        }

    }

    public  function exportExcel(Request $request)
    {
        $exam = $request->exam;

        $ex = Exam::find($exam);
        $filename = $ex->classroom->name . '_' . $ex->shift->name . '_' . $ex->start_date;
        $data = [];
        $exam_results = UserExam::query()->where('exam_id','=',$exam)->get();

        foreach ($exam_results as $exam_result)
        {

            $data[] = [
                'user_id' => $exam_result->user_id,
                'username' => $exam_result->user->username,
                'score' => ''
            ];
        }

        return Excel::create($filename, function($excel) use ($data) {
            $excel->sheet('sheet1', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('csv');
    }

    public  function exportUserExamExcel(Exam $exam)
    {
        $filename = $exam->course->name.'_'.$exam->classroom->name . '_' . $exam->shift->name . '_' . $exam->start_date;
        $data = [];
        $exs = UserExam::query()->where('exam_id','=',$exam->id)->get();

        foreach ($exs as $ex)
        {

            $data[] = [
                'user_id' => $ex->user_id,
                'email' => $ex->user->email,
                'username' => $ex->user->username,
            ];
        }

        return Excel::create($filename, function($excel) use ($data) {
            $excel->sheet('sheet1', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('csv');
    }

    public  function preview(Request $request)
    {
        $courses = Course::all();
        $filCourse = $request->course;
        $filExam = $request->exam;
        $fScore = $request->fscore;
        $lScore = $request->lscore;

        $exams = Exam::query()->where('course_id','=',$filCourse)->get();
        $examResults = Exam_Result::query()->where('exam_id','=',$filExam)
            ->where('score','>=',$fScore)
            ->where('score','<=',$lScore)
            ->paginate(30);
        return view('admin.exams.result',
            [
                'exams' => $exams,
                'filCourse' => $filCourse,
                'filExam' => $filExam,
                'courses' => $courses,
                'examResults' => $examResults

            ]);
    }

    public function arrangeStudent(ExamPreviewRequest $request)
    {
        $type = $request->type;
        $class = $request->class;
        $filCourse = $request->filCourse;
        if($type == 1)
        {
            $num1 = $request->num_studen_1;
            $class_id =  Classes::query()->where('course_id',$filCourse)->select('id')->get();
            $users = User_Class::query()->whereIn('class_id',$class_id)->select('user_id')->get();
            $exams = Exam::query()->where('course_id','=',$filCourse)->select('id')->get();
            $examResults = Exam_Result::query()
                ->whereIn('exam_id',$exams)
                ->whereNotIn('user_id',$users)
                ->take($num1)
                ->get();
            $data = [];

            foreach ($examResults as $examResult)
            {
                $data[] = [
                    'user_id' => $examResult->user_id,
                    'class_id' => $class
                ];
            }

            User_Class::query()->insert($data);
            flash()->success('Thêm học viên vào lớp thành công!');
            return redirect()->back();

        }
        else
        {
            $fscore = $request->fScore;
            $lscore = $request->lScore;
            $num2 = $request->num_studen_2;


            $class_id =  Classes::query()->where('course_id',$filCourse)->select('id')->get();
            $users = User_Class::query()->whereIn('class_id',$class_id)->select('user_id')->get();
            $exams = Exam::query()->where('course_id','=',$filCourse)->select('id')->get();
            if($num2 == 0)
            {
                $examResults = Exam_Result::query()
                    ->whereIn('exam_id',$exams)
                    ->whereNotIn('user_id',$users)
                    ->where('score','>',$fscore)
                    ->where('score','<=',$lscore)
                    ->get();
            }
            else
            {
                $examResults = Exam_Result::query()
                    ->whereIn('exam_id',$exams)
                    ->whereNotIn('user_id',$users)
                    ->where('score','>',$fscore)
                    ->where('score','<=',$lscore)
                    ->take($num2)
                    ->get();
            }

            $data = [];

            foreach ($examResults as $examResult)
            {
                $data[] = [
                    'user_id' => $examResult->user_id,
                    'class_id' => $class
                ];
            }

            User_Class::query()->insert($data);
            flash()->success('Thêm học viên vào lớp thành công!');
            return redirect()->back();


        }
    }
}
