<?php

namespace App\Http\Controllers\Admin;
use App\ChangeClassSession;
use App\Class_Session;
use App\Classroom;
use App\Detail_Voucher;
use App\Exam;
use App\Exam_Result;
use App\Exercise;
use App\Http\Controllers\Controller;

use App\Classes;
use App\Course;
use App\Http\Requests\Admin\SchedulerStoreRequest;
use App\ResultTest;
use App\Schedule_Class;
use App\User;
use App\User_Class;
use App\User_Course;
use App\Voucher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AjaxController extends Controller
{
    //
    public  function __construct()
    {
    }

    public  function  getClassTypeTable($course_id)
    {
        $classes = Classes::where('course_id', $course_id)->get();
    }

    public  function getClassTypeSelect($course_id)
    {
        if($course_id==-1)
        {
            $class = Classes::all();
        }
        else
        {
            $class= Classes::where('course_id',$course_id)->get();
        }
        $i=1;
        foreach ($class as $class)
        {
            if($i==1)
            {
                echo ('<option value="'.$class->id.'" selected>'.$class->name.'</option>');
            }
            else
            {
                echo ('<option value="'.$class->id.'">'.$class->name.'</option>');
            }
            $i++;
        }
    }


    public  function  getRoomByShiftAndDay(Request $request)
    {
        $day = $request->day;
        $shift = $request->shift;

        $arrroom_id = array();


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

        $rooms1 = Class_Session::query()
            ->where('start_date','=',$day)
            ->whereIn('shift_id',$shift_id)
            ->where('state','=',0)
            ->get();

        $rooms2 = Exam::query()
            ->where('start_date','=',$day)
            ->whereIn('shift_id',$shift_id)
            ->where('state','=',0)
            ->get();


        foreach ($rooms1 as $room)
        {
            array_push($arrroom_id, $room->classroom_id);
        }

        foreach ($rooms2 as $room)
        {
            array_push($arrroom_id, $room->classroom_id);
        }

        $rooms = Classroom::query()->whereNotIn('id',$arrroom_id)->get();

        $i=1;
        foreach ($rooms as $room)
        {
            if($i==1)
            {
               echo('<option value="'.$room->id.'" selected>'.$room->name.'</option>');
            }
            else
            {
                echo ('<option value="'.$room->id.'">'.$room->name.'</option>');
            }
            $i++;
        }
    }

    public  function getDetailCourse($course_id)
    {
        $course = Course::query()->where('id',$course_id)->get();

        $detail = 'Khoa học bắt đầu từ ngày: '.$course[0]->start_date.' và kết thúc vào ngày: '.$course[0]->end_date;
        echo('
            <label for="inputEmail3" class="control-label">'.$detail.'</label>
        ');
    }



    public  function getClassroom(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'start_date' => 'required|date_format:Y-m-d|after:yesterday',
            'end_date' => 'required|date_format:Y-m-d|after:yesterday',
            'weekday' =>'required|digits_between:0,6',
            'shift' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all(),
                'state' => false]);
        }
        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        $ngaychenhlech = ($request->weekday - $start_date->dayOfWeek);
            if($ngaychenhlech < 0) {
                $ngaychenhlech += 7;
            }

            $firstDayStudy = (clone $start_date)->addDay($ngaychenhlech);



        //    return $days;
        $danhsachphongcolich = [];
        for ($dayStudy = $firstDayStudy; $dayStudy->lessThanOrEqualTo($end_date); $dayStudy->addWeek()) {
            $start = clone $dayStudy;

            $rooms1 = Class_Session::query()
                ->where('start_date','=',$start->toDateString())
                ->where('shift_id','=',$request->shift)
                ->where('state','!=','2')
                ->get();
            $rooms2 = Exam::query()->where('start_date','=',$start->toDateString())
                ->where('shift_id','=',$request->shift)
                ->where('state','!=','2')
                ->get();
            foreach ($rooms1 as $room)
            {
                array_push($danhsachphongcolich, $room->classroom_id);
            }

            foreach ($rooms2 as $room)
            {
                array_push($danhsachphongcolich, $room->classroom_id);
            }
        }
        $danhSachNgayCanCheck = Classroom::query()->whereNotIn('id',$danhsachphongcolich)->get();
        return response()->json(['success'=>$danhSachNgayCanCheck,
            'state' => true]);
    }

    public function checkChangeClassSession($change_id)
    {
        $change = ChangeClassSession::find($change_id);

        $start_date = $change->start_date;
        $shift = $change->shift_id;
        $classroom = $change->classroom_id;

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
            return response()->json(['errors' => 'Phòng học không sàng!']);
        }
        else
        {
            return response()->json(['success' => 'Phòng học sẵn sàng!']);
        }
    }






    public  function  getUsername(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        $email = $request->email;

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all(),
                'state' => false]);
        }

        $student = User::query()->where('email','=',$email)->first();


        if($student != null)
        {
            $infor = 'Họ tên: '.$student->username.'. Địa chỉ: '.$student->address;
            return response()->json(['success'=>$infor,
                'state' => true
            ]);
        }
        else
        {
            return response()->json(['errors'=> 'Tài khoản không tồn tại !',
                'state' => false
                ]);
        }

    }

    public function getStudents(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_score' => 'required|numeric|min:0|max:999',
            'last_score' => 'required|numeric|min:0|max:999',
            'course' => 'required',
            'num_studnet' => 'required|numeric'
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all(),
                'state' => false]);
        }
        $fscore = $request->first_score;
        $lscore = $request->last_score;
        $course = $request->course;
        $num = $request->num_studnet;
        if($fscore > $lscore)
        {
            return response()->json(['errors' => 'The first_score must be greater than or equal to the last_score!',
                'state' => false
            ]);
        }
        $class_id =  Classes::query()->where('course_id',$course)->select('id')->get();
        $users = User_Class::query()->whereIn('class_id',$class_id)->select('user_id')->get();
        $exams = Exam::query()->where('course_id','=',$course)->select('id')->get();
        if($num == 0)
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
                ->take($num)
                ->get();
        }
        $datasss = [];
        foreach ($examResults as $examResult)
        {
            $datasss[] = [
                'user_id' =>$examResult->user_id,
                'username' => $examResult->user->username,
                'score' => $examResult->score
            ];
        }


        return response()->json(['success'=>$datasss,
            'state' => true]);
    }

    public  function checkVoucher(Request $request)
    {
        $voucher = Detail_Voucher::query()
            ->where('code','=',$request->voucher)
            ->where('state','=',0)
            ->first();

        if ($voucher == null)
        {
            return response()->json(['errors'=> 'Voucher đã được dùng hoặc không đúng!',
            'state' => false]);
        }
        else
        {
            $course = Course::query()->where('id','=',$request->course)->first();
            $value = $voucher->value;
            $lprice = ($course->price*(100-$value))/100;
            return response()->json(['success'=> $lprice,
                'state' => true]);
        }


    }

    public  function getPrice(Request $request)
    {
        $now = Carbon::now();
        $now2 = Carbon::now();
        $daycheck = $now->subDay(7+$now2->dayOfWeek);
        $strdaycheck = $daycheck->toDateString();
        $course = Course::query()
            ->where('id','=',$request->course)
            ->whereDate('start_date','>=',$strdaycheck)->first();

        if($course == null)
        {
            return response()->json(['errors'=> 'Data was outdate!',
                'state' => false]);
        }
        else
        {
            return response()->json(['success'=> $course->price,
                'state' => true]);
        }
    }



    public  function  getExam(Request $request)
    {
        $exams = Exam::query()->where('course_id','=',$request->course)->get();
        $i=1;
        foreach ($exams as $exam)
        {
            if($i++ ==1)
            {
                echo ('<option value="'.$exam->id.'" selected>'.$exam->shift->name.' - '.$exam->classroom->name.'
                            - '.$exam->start_date.' </option>');
            }
            else
            {
                echo ('<option value="'.$exam->id.'">'.$exam->shift->name.' - '.$exam->classroom->name.'
                            - '.$exam->start_date.' </option>');
            }
        }
    }

    public  function  getExamResult(Request $request)
    {
        $exam = $request->exam;
        echo $exam;
    }

}
