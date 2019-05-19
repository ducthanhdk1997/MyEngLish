<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Detail_Voucher;
use App\Http\Requests\Admin\UserCourseStoreRequest;
use App\User;
use App\User_Course;
use App\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentCourseController extends Controller
{
    //

    public  function index()
    {
        $now = Carbon::now();
        $now2 = Carbon::now();
        $daycheck = $now->subDay(7+$now2->dayOfWeek);
        $strdaycheck = $daycheck->toDateString();
        $courses = Course::query()->whereDate('start_date','>=',$strdaycheck)->get();

        $price = $courses->first()->price;
        return view('admin.course_student.index',[
            'courses' => $courses,
            'price' => $price
        ]);
    }

    public  function store(UserCourseStoreRequest $request)
    {

        $now = Carbon::now();
        $now2 = Carbon::now();
        $daycheck = $now->subDay(7+$now2->dayOfWeek);
        $strdaycheck = $daycheck->toDateString();


        $student = User::query()->where('email','=',$request->email)->first();
        if($student != null)
        {
            $dadong = User_Course::query()
                ->where('user_id','=',$student->id)
                ->where('course_id','=',$request->course)
                ->first();
                if($dadong !=null)
                {
                    flash()->error('Học viên đã đóng học trước đó!');
                    return redirect()->back();

                }
            $course = Course::query()
                ->where('id','=',$request->course)
                ->whereDate('start_date','>=',$strdaycheck)->first();

            if($course !=null)
            {
                if($request->voucher != '')
                {
                    $voucher = Detail_Voucher::query()
                        ->where('code','=',$request->voucher)
                        ->where('state','=',0)
                        ->first();

                    if($voucher !=null)
                    {
                        $lprice = ($course->price*(100-$voucher->value))/100;
                        $user_course = new User_Course();
                        $user_course->user_id = $student->id;
                        $user_course->state = 1;
                        $user_course->total_amount =  $lprice;
                        $user_course->voucher_id = $voucher->id;
                        $user_course->course_id = $course->id;


                        if($user_course->save())
                        {
                            Detail_Voucher::query()->where('id','=',$voucher->id)
                                ->update(['state' => 1]);

                            flash()->success('Đóng học phí thành công');
                            return redirect()->route('admin.user_course.bill',$user_course);
                        }
                    }
                    else
                    {
                        flash()->error('Voucher không đúng!');
                        return redirect()->back();
                    }

                }
                else
                {
                    $user_course = new User_Course();
                    $user_course->user_id = $student->id;
                    $user_course->state = 1;
                    $user_course->total_amount =  $course->price;
                    $user_course->voucher_id = null;
                    $user_course->course_id = $course->id;
                    if($user_course->save())
                    {
                        flash()->success('Đóng học phí thành công');
                        return redirect()->route('admin.user_course.bill',$user_course);
                    }
                }
            }
            else
            {
                flash()->error('Data was outdate!');
                return redirect()->back();
            }

        }
        else
        {
            flash()->error('Học viên không tồn tại!');
            return redirect()->back();
        }
    }

    public function buil( User_Course $user_course)
    {
        return view('admin.course_student.bill',['user_course' =>$user_course]);
    }

    public function detail(Request $request)
    {
        $courses = Course::all();
        if(!empty($request->filCourse)){
            $filCourse = $request->filCourse;
            $userCoursess = User_Course::query()->where('course_id','=',$filCourse)->get();
            $userCourses = User_Course::query()->where('course_id','=',$filCourse)->paginate(30);
            $cou  = Course::find($filCourse);
            $total = 0;
            foreach ($userCoursess as $userCours)
                $total += $userCours->total_amount;
            return view('admin.finance.index',
                [

                    'filCourse' => $filCourse,
                    'userCourses' => $userCourses,
                    'courses' => $courses,
                    'cou' => $cou,
                    'total' => $total
                ]);

        }
        else
        {
            $course = $courses->first();
            $userCoursess = User_Course::query()->where('course_id','=',$course->id)->get();
            $userCourses = User_Course::query()->where('course_id','=',$course->id)->paginate(30);
            $total = 0;
            foreach ($userCoursess as $userCours)
                $total += $userCours->total_amount;
            return view('admin.finance.index',
                [
                    'userCourses' => $userCourses,
                    'courses' => $courses,
                    'cou' => $course,
                    'total' => $total
                ]);
        }
    }

    public function detailByquater(Request $request)
    {
        $date = Carbon::now();
        $start_date = $date->year.'-01-01';
        $end_date = $date->year.'-03-31';
        if(!empty($request->filter)){
            $filter = $request->filter;

            $start_date = '';
            $end_date = '';
            if($filter == -1)
            {
                $start_date = $date->year.'-01-01';
                $end_date = $date->year.'-12-31';
            }
            if($filter == 1)
            {
                $start_date = $date->year.'-01-01';
                $end_date = $date->year.'-03-31';
            }
            if($filter == 2)
            {
                $start_date = $date->year.'-04-01';
                $end_date = $date->year.'-06-30';
            }
            if($filter == 3)
            {
                $start_date = $date->year.'-07-01';
                $end_date = $date->year.'-09-30';
            }
            if($filter == 4)
            {
                $start_date = $date->year.'-10-01';
                $end_date = $date->year.'-12-31';
            }

            $courses = Course::query()
                ->where('start_date','>=', $start_date)
                ->where('start_date','<=',$end_date)
                ->get();

            $course_id = Course::query()
                ->where('start_date','>=', $start_date)
                ->where('start_date','<=',$end_date)
                ->select('id')
                ->get();
            $userCoursess = User_Course::query()->whereIn('course_id',$course_id)->get();

            $sc = $userCoursess->count();
            $userCourses = User_Course::query()->whereIn('course_id',$course_id)->paginate(30);
            $total = 0;
            foreach ($userCoursess as $userCours)
                $total += $userCours->total_amount;
            return view('admin.finance.quarter_finance',
                [

                    'filter' => $filter,
                    'userCourses' => $userCourses,
                    'courses' => $courses,
                    'total' => $total,
                    'sc' => $sc
                ]);

        }
        else
        {

            $courses = Course::query()
                ->where('start_date','>=', $start_date)
                ->where('start_date','<=',$end_date)
                ->get();

            $course_id = Course::query()
                ->where('start_date','>=', $start_date)
                ->where('start_date','<=',$end_date)
                ->select('id')
                ->get();

            $userCoursess = User_Course::query()->whereIn('course_id',$course_id)->get();
            $userCourses = User_Course::query()->whereIn('course_id',$course_id)->paginate(30);
            $total = 0;

            $sc = $userCoursess->count();
            foreach ($userCoursess as $userCours)
                $total += $userCours->total_amount;
            return view('admin.finance.quarter_finance',
                [
                    'userCourses' => $userCourses,
                    'courses' => $courses,
                    'total' => $total,
                    'sc' => $sc
                ]);
        }
    }
}
