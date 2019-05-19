<?php

namespace App\Http\Controllers\Teacher;

use App\ChangeClassSession;
use App\Class_Session;
use App\Classes;
use App\Classroom;
use App\Exam;
use App\Exam_Result;
use App\Http\Requests\Teacher\StoreChangeClassSessionRequest;
use App\Shift;
use App\User;
use App\User_Class;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassController extends Controller
{
    //

    public function index(Request $request)
    {
        $teacher = \Auth::user();
        if(!empty($request->filter)){
            $filter = $request->filter;
            if($filter == -1)
            {
                $classes = Classes::query()
                    ->where('teacher_id','=',$teacher->id)
                    ->paginate(10);

                return view('teacher.classes.index',
                    [
                       'classes' => $classes,
                        'filter' => $filter
                    ]);
            }
            else
            {
                if($filter==1)
                {
                    $classes = Classes::query()
                        ->where('teacher_id','=',$teacher->id)
                        ->where('state','=',false)
                        ->paginate(10);

                    return view('teacher.classes.index',
                        [
                            'classes' => $classes,
                            'filter' => $filter
                    ]);
                }
                else
                {
                    $classes = Classes::query()
                        ->where('teacher_id','=',$teacher->id)
                        ->where('state','=',true)
                        ->paginate(10);

                    return view('teacher.classes.index',
                        [
                            'classes' => $classes,
                            'filter' => $filter
                        ]);
                }
            }
        }
        else
        {
            $classes = Classes::query()
                ->where('teacher_id','=',$teacher->id)
                ->paginate(10);

            return view('teacher.classes.index',
                [
                    'classes' => $classes,
                ]);
        }
    }

    public function detail(Classes $class)
    {
        $usersClass = User_Class::query()
            ->with('user')
            ->where('class_id', $class->id)
            ->paginate(10);

        return view('teacher.classes.detail', [
            'usersClass' => $usersClass,
            'class' => $class,

        ]);
    }

    public function student_test(Classes $class)
    {
        $exams = Exam::query()
            ->where('course_id','=',$class->course_id)
            ->select('id')->get();

        $tests = $class->test()->get();
        $users = $class->users()->paginate(10);
        return view('teacher.classes.user_test', [
            'users' => $users,
            'class' => $class,
            'tests' => $tests,
            'exams' => $exams
        ]);
    }


    public function change_class_session()
    {
        $teacher = \Auth::user();
        $classes = Classes::query()
            ->where('teacher_id','=',$teacher->id)
            ->where('state','=',false)
            ->get();

        if($classes != null)
        {
            $class_sessions = Class_Session::query()->where('class_id','=',$classes->first()->id)->get();
            $today = Carbon::now();
            $day = $today->toDateString();
            $shift = Shift::all();
            $classrooms = Classroom::all();
            return view('teacher.other.register_miss_session',[
                'shifts' => $shift,
                'classrooms' => $classrooms,
                'classes' => $classes,
                'day' => $day,
                'class_sessions' => $class_sessions
            ]);
        }
        else
        {
            return view('teacher.other.register_miss_session',[
                'shifts' => '',
                'classrooms' => '',
                'classes' => '',
                'day' => '',
                'class_sessions' => ''
            ]);
        }



    }

    public  function store_change_class_session(StoreChangeClassSessionRequest $request,  $teacher)
    {

        $shift = $request->shift_id;
        $start_date = $request->start_date;
        $class_session = $request->class_session;
        $classroom = $request->classroom_id;
        $reason = $request->reason;

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

        $exam = Exam::query()
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

        $change_cl_ss = ChangeClassSession::query()->where('class_session_id','=',$class_session)->count();
        if($exam !=0 || $class_ss !=0 || $change_cl_ss !=0)
        {
            flash()->error('Dữ liệu đã lỗi thời');
            return redirect()->back();
        }

        $change_class_session = new ChangeClassSession();
        $change_class_session->reason = $reason;
        $change_class_session->class_session_id = $class_session;
        $change_class_session->state = 0;
        $change_class_session->user_id = $teacher;
        $change_class_session->start_date = $start_date;
        $change_class_session->shift_id = $shift;
        $change_class_session->classroom_id = $classroom;

        if($change_class_session->save())
        {
            flash()->success('Yêu cầu của bạn đã được gửi để phê duyệt!');
            return redirect()->back();
        }
        else
        {
            flash()->error('Yêu cầu của bạn chưa được gửi để phê duyệt!');
            return redirect()->back();
        }
    }
}
