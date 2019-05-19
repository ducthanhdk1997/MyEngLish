<?php

namespace App\Http\Controllers\Admin;

use App\Class_Session;
use App\Exam;
use App\Notification;
use App\Schedule_Class;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class ChangeClassSession extends Controller
{
    //

    public function index()
    {

    }

    public function update(\App\ChangeClassSession $change_class_session)
    {
        $weekdays = [1 => 'Thứ 2', 2 => 'Thứ 3', 3 => 'Thứ 4', 4 => 'Thứ 5', 5 => 'Thứ 6', 6 => 'Thứ 7', 7 => 'CN'];
        $start_date1 = \Carbon\Carbon::parse($change_class_session->class_session->start_date);
        $start_date2 = \Carbon\Carbon::parse($change_class_session->start_date);

        $start_date = $change_class_session->start_date;
        $shift = $change_class_session->shift_id;
        $classroom = $change_class_session->classroom_id;
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

        $class_session = $change_class_session->class_session()->first();
        $class = $class_session->class()->first();

        $students = $class->users()->get();


        $class_session->state = 2;
        $class_session->save();

        $sdate = Carbon::parse($start_date);

        $schedule_class = new Schedule_Class();
        $schedule_class->start_date = $start_date;
        $schedule_class->shift_id = $shift;
        $schedule_class->classroom_id = $classroom;
        $schedule_class->class_id = $class->id;
        $schedule_class->weekday = $sdate->dayOfWeek;
        $schedule_class->end_date = $start_date;
        if ($schedule_class->save()) {

            $class_ses = new Class_Session();
            $class_ses->start_date = $start_date;
            $class_ses->shift_id = $shift;
            $class_ses->classroom_id = $classroom;
            $class_ses->class_id = $class->id;
            $class_ses->schedule_id = $schedule_class->id;
            $class_ses->state = 0;

            if($class_ses->save())
            {
                $notification = new Notification();
                $title = 'Thông báo về yêu cầu chuyển lịch học của lớp: '.$change_class_session->class_session->class->name;
                $content = $title.' đã "thành công!" Vui lòng vào phần lịch học để xem chi tiết.';
                $notification->title = $title;
                $notification->content = $content;
                $notification->user_id = $change_class_session->user_id;
                $notification->state = 0;
                $notification->save();

                foreach ($students as $student)
                {
                    $notification = new Notification();
                    $title = 'Thông báo về chuyển lịch học.';
                    $content = $title.' của lớp '.$change_class_session->class_session->class->name.
                        '. Lịch học của bạn đã được chuyển: '.
                        ' Từ '. $weekdays[$start_date1->dayOfWeek].' - ngày '.
                        $change_class_session->class_session->start_date.
                        ' sang: '.$weekdays[$start_date2->dayOfWeek].
                        ' - ngày '.$change_class_session->start_date.
                        '. Vui lòng vào lịch học để xem chi tiết.';
                    $notification->title = $title;
                    $notification->content = $content;
                    $notification->user_id = $student->id;
                    $notification->state = 0;
                    $notification->save();
                }

                $change_class_session->state = 1;
                if($change_class_session->save())
                {
                    flash()->success('Thành công!');
                    return redirect()->back();
                }
                else
                {
                    flash()->error('Không thành công!');
                    return redirect()->back();
                }
            }
            else
            {
                flash()->error('Không thành công!');
                return redirect()->back();
            }
        }
        else
        {
            flash()->error('Không thành công!');
            return redirect()->back();
        }

    }

    public function cancel(\App\ChangeClassSession $change_class_session)
    {
        $notification = new Notification();
        $weekdays = [1 => 'Thứ 2', 2 => 'Thứ 3', 3 => 'Thứ 4', 4 => 'Thứ 5', 5 => 'Thứ 6', 6 => 'Thứ 7', 7 => 'CN'];
        $start_date1 = \Carbon\Carbon::parse($change_class_session->class_session->start_date);
        $start_date2 = \Carbon\Carbon::parse($change_class_session->start_date);
        $title = 'Thông báo về yêu cầu chuyển lịch học của lớp: '.$change_class_session->class_session->class->name;
        $content = 'Thông báo về yêu cầu chuyển lịch học của lớp: '.
            $change_class_session->class_session->class->name.
            ' Từ '. $weekdays[$start_date1->dayOfWeek].' - ngày '.
            $change_class_session->class_session->start_date.
            ' sang: '.$weekdays[$start_date2->dayOfWeek].
            ' - ngày '.$change_class_session->start_date.
            ' là "không thành công"'.
            '. Vì lý do phòng đã được đặt từ trước hoặc lý do khác.';

        $notification->title = $title;
        $notification->content = $content;
        $notification->user_id = $change_class_session->user_id;
        $notification->state = 0;

        $change_class_session->state = 1;
        if($notification->save() && $change_class_session->save())
        {
            flash()->success('Hủy thành công, thông báo đã được gửi tới giảng viên!');
            return redirect()->back();
        }
        else
        {
            flash()->error('Hủy không thành công!');
            return redirect()->back();
        }




    }
}
