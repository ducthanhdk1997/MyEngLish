<?php

namespace App\Http\Controllers\Admin;

use App\Class_Session;
use App\Classes;
use App\Classroom;
use App\Exam;
use App\Http\Requests\Admin\ClassSessionStoreRequest;
use App\Http\Requests\Admin\SchedulerStoreRequest;
use App\Schedule_Class;
use App\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\DocBlock;

class ClassSessionController extends Controller
{
    //

    public  function index()
    {

        return view('admin.schedules.index');
    }
    public  function  create(Classes $class)
    {
        $shifts = Shift::all();
        $classrooms = Classroom::all();
        $start_date = $class->course->start_date;
        $end_date = $class->course->end_date;

        return view('admin.schedules.create',[
            'shifts' => $shifts,
            'classrooms' => $classrooms,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'class' => $class
        ]);

    }

    public function updateState(Class_Session $class_session)
    {
        $today = Carbon::now();
        $day = $today->toDateTimeString();
        $comp = $class_session->start_date.' '.$class_session->shift->start_time;
        if (strtotime($day) >= strtotime($comp)) {
            $class_session->state = 1;
            $class_session->save();
            flash()->success('Thay đổi thành công!');
            return redirect()->back();
        } else {
            flash()->error('Lịch học chưa kết thúc !');
            return redirect()->back();
        }
    }

    public  function  store(ClassSessionStoreRequest $request, Classes $class )
    {
        $shift = $request->shifts;
        $classroom = $request->classroom;
        $weekday = $request->weekdays;

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


        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        $ngaychenhlech = ($weekday - $start_date->dayOfWeek);
        if ($ngaychenhlech < 0) {
            $ngaychenhlech += 7;
        }
        $firstDayStudy = (clone $start_date)->addDay($ngaychenhlech);

        for ($dayStudy = clone $firstDayStudy; $dayStudy->lessThanOrEqualTo($end_date); $dayStudy->addWeek()) {
            $start = clone $dayStudy;


            $class_session = Class_Session::query()
                ->where('start_date', '=', $start->toDateString())
                ->whereIn('shift_id',  $shift_id)
                ->where('classroom_id', '=', $request->classroom)
                ->where('state','=','0')
                ->count();

            $exam = Exam::query()
                ->where('start_date', '=', $start->toDateString())
                ->whereIn('shift_id',  $shift_id)
                ->where('classroom_id', '=', $request->classroom)
                ->where('state','=','0')
                ->count();

            if ($class_session != 0 || $exam != 0) {
                $message = 'Data was outdate';
                return redirect()->back()
                    ->with('messages', $message);

            }
        }

        $schedule_class = new Schedule_Class();
        $schedule_class->start_date = $request->start_date;
        $schedule_class->shift_id = $request->shifts;
        $schedule_class->classroom_id = $request->classroom;
        $schedule_class->class_id = $class->id;
        $schedule_class->weekday = $request->weekdays;
        $schedule_class->end_date = $request->end_date;

        $checkScheduleClass = false;
        if ($schedule_class->save()) {
            $checkScheduleClass = true;
        }


        $checkSaveSchedule = true;
        $firstDayStudy = (clone $start_date)->addDay($ngaychenhlech);

        DB::transaction(function () use ($class, $classroom, $shift, $end_date, $firstDayStudy, $schedule_class) {
            for ($dayStudy = clone $firstDayStudy; $dayStudy->lessThanOrEqualTo($end_date); $dayStudy->addWeek()) {
                $start = clone $dayStudy;
                $class_session = new Class_Session();
                $class_session->start_date = $start->toDateString();
                $class_session->shift_id = $shift;
                $class_session->classroom_id = $classroom;
                $class_session->class_id = $class->id;
                $class_session->schedule_id = $schedule_class->id;
                $class_session->state = 0;
                $class_session->save();

                if( !$class_session )
                {
                    throw new \Exception('Không thể tạo lịch');
                }
            }
        });




        if ($checkScheduleClass == true && $checkSaveSchedule == true) {
            flash()->success('Tạo lịch học thành công');
            return redirect()->route('admin.classes.schedule', $class->id);
        } else {
            flash()->error('Tạo lịch học thất bại');
            return redirect()->route('admin.classes.schedule', $class->id);
        }

    }

    public  function  edit(Schedule_Class $schedule)
    {
        $start_date = Carbon::parse($schedule->start_date);
        $end_date = Carbon::parse($schedule->end_date);

        $ngaychenhlech = ($schedule->weekday - $start_date->dayOfWeek);
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
                ->where('shift_id','=',$schedule->shift_id)
                ->where('state','!=','1')
                ->get();
            $rooms2 = Exam::query()
                ->where('start_date','=',$start->toDateString())
                ->where('shift_id','=',$schedule->shift_id)
                ->where('state','!=','1')
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


        $shifts = Shift::all();


        return view('admin.schedules.exit',
            [
                'schedule' => $schedule,
                'shifts' => $shifts,
                'rooms' => $danhSachNgayCanCheck
            ]);
    }

    public  function update(ClassSessionStoreRequest $request, Schedule_Class $schedule)
    {
        $shift = $request->shifts;
        $classroom = $request->classroom;
        $weekday = $request->weekdays;

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
        $class = Classes::query()->where('id','=',$schedule->class_id)->get();


        $start_date = Carbon::parse($request->start_date);
        $end_date = Carbon::parse($request->end_date);

        $ngaychenhlech = ($weekday - $start_date->dayOfWeek);
        if ($ngaychenhlech < 0) {
            $ngaychenhlech += 7;
        }
        $firstDayStudy = (clone $start_date)->addDay($ngaychenhlech);

        for ($dayStudy = clone $firstDayStudy; $dayStudy->lessThanOrEqualTo($end_date); $dayStudy->addWeek()) {
            $start = clone $dayStudy;

            $class_session = Class_Session::query()
                ->where('start_date', '=', $start->toDateString())
                ->whereIn('shift_id',  $shift_id)
                ->where('classroom_id', '=', $request->classroom)
                ->where('state','!=','2')
                ->count();

            $exam = Exam::query()->where('start_date', '=', $start->toDateString())
                ->whereIn('shift_id',  $shift_id)
                ->where('classroom_id', '=', $request->classroom)
                ->where('state','!=','2')
                ->count();

            if ($class_session != 0 || $exam != 0) {
                $message = 'Data was outdate';
                return redirect()->back()
                    ->with('messages', $message);

            }
        }


        //tao lich chung
        $schedule->start_date = $request->start_date;
        $schedule->shift_id = $request->shifts;
        $schedule->classroom_id = $request->classroom;
        $schedule->weekday = $request->weekdays;
        $schedule->class_id = $schedule->class_id;
        $schedule->end_date = $request->end_date;

        $checkScheduleClass = false;
        if ($schedule->save()) {
            $deleteSession = Class_Session::query()->where('schedule_id','=',$schedule->id)
                ->delete();


            $checkSaveSchedule = 0;
            $firstDayStudy = (clone $start_date)->addDay($ngaychenhlech);


            for ($dayStudy = clone $firstDayStudy; $dayStudy->lessThanOrEqualTo($end_date); $dayStudy->addWeek()) {
                $start = clone $dayStudy;
                $class_session = new Class_Session();
                $class_session->start_date = $start->toDateString();
                $class_session->shift_id = $shift;
                $class_session->classroom_id = $classroom;
                $class_session->class_id = $schedule->class_id;
                $class_session->schedule_id = $schedule->id;
                $class_session->state = 0;
                if($class_session->save() == false)
                {
                    $checkSaveSchedule++;
                }
            }

            if ($checkSaveSchedule==0)
            {
                flash()->success('Tạo lịch học thành công');
                return redirect()->route('admin.classes.schedule', $schedule->class_id);
            }
            else
            {
                flash()->error('Tạo lớp thất bại');
                return redirect()->route('admin.schedule.edit', $schedule->id);
            }

        }
        else
        {
            flash()->error('Tạo lớp thất bại');
            return redirect()->route('admin.schedule.edit', $schedule->id);
        }
    }
}
