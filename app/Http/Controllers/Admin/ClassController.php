<?php

namespace App\Http\Controllers\Admin;

use App\Classes;
use App\Classroom;
use App\Course;
use App\Http\Requests\Admin\AddUserStoreRequest;
use App\Http\Requests\Admin\ClassStoreRequest;
use App\Schedule_Class;
use App\Shift;
use App\User;
use App\User_Class;
use App\User_Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use Maatwebsite\Excel\Excel;
use Excel;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();
        $scheduleclass = Schedule_Class::all();
        $classes = Classes::query()->paginate(10);
        $course_id = -1;
        return view('admin.classes.index',
            [
                'classes'=>$classes,
                'courses'=>$courses,
                'course_id'=>$course_id,
                'scheduleclass' => $scheduleclass
            ]);
    }

    public  function showByCourses($course_id)
    {
        $courses = Course::all();

        if($course_id>0)
        {
            $classes = Classes::query()->where('course_id',$course_id)->paginate(10);
            return view('admin.classes.index', ['classes'=>$classes,'courses'=>$courses,'course_id'=>$course_id]);

        }
        else{
            $classes = Classes::query()->paginate(10);
            return view('admin.classes.index', ['classes'=>$classes,'courses'=>$courses,'course_id'=>$course_id]);
        }


    }

    public  function schedule(Classes $class)
    {

        $scheduldeclass = Schedule_Class::query()->where('class_id','=',$class->id)->get();
        return view('admin.classes.schedule',[

            'class' => $class,
            'schedules' => $scheduldeclass
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $today = Carbon::now();
        $day = $today->toDateString();
        $shift = Shift::all();
        $classrooms = Classroom::all();
        $courses = Course::all();
        $teachers = User::query()
            ->where('role_id',3)
            ->get();
        return view('admin.classes.add', ['courses'=>$courses
                                        ,'classrooms'=>$classrooms
                                        , 'teachers'=>$teachers
                                        ,'day'=>$day
                                        ,'shifts'=>$shift]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassStoreRequest $request)
    {
        $class = new Classes();
        $class->name = $request->name;
        $class->teacher_id = $request->teacher;
        $class->course_id = $request->course_id;
        if($class->save()){
            flash()->success('Tạo lớp học thành công');
            return redirect()->route('admin.classes.index');
        }
        else{
            flash()->error('Tạo lớp thất bại');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {


        $usersClass = User_Class::query()
            ->with('user')
            ->where('class_id', $class->id)
            ->paginate(10);

        return view('admin.classes.detail', [
            'usersClass' => $usersClass,
            'class' => $class,

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        $teachers = User::query()
            ->where('role_id', 3)
            ->get();
        return view('admin.classes.edit', compact('class', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClassStoreRequest $request, Classes $class)
    {
        $class->name = $request->name;
        $class->teacher_id = $request->teacher;

        if($class->save()){
            flash()->success('Cap nhat thanh cong');
        }
        else{
            flash()->error("cap nhat that bai");
        }
        return redirect()->route('admin.classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        if($class->delete()){
            flash()->success('Xóa lớp học thành công');
        }
        else{
            flash()->error('Xóa tài khoản thất bại');
        }
        return redirect()->back();
    }

    public function importStudent(Request $request, Classes $class){
        if(!$request->hasFile('file-excel')){
            return redirect()->back()->withErrors("No file selected");
        }
        $file = $request->file('file-excel');
        if(!$file->getclientoriginalextension() == "xlsx"){
            return redirect()->back()->withErrors("Selected file is not excel file");
        }
        $filename = $file->getClientOriginalName();
        $file->move('excel', $filename);
        $filePath = 'public/excel/' . $filename;
//        $filePath = public_path('excel/' . $filename);
        $reader = Excel::load($filePath);

//        dd($reader->toArray());

        foreach ($reader->toArray() as $key => $row){
            $password = bcrypt('secret');
            $student = User::query()->firstOrCreate([
                'email' => $row['email']
            ],
            [
                'password' => $password,
                'username' => $row['ho_ten'],
                'gender' => $row['gioi_tinh'],
                'phone' => $row['so_dien_thoai'],
            ]);
            $student = User::query()
                ->where('email', $row['email'])
                ->update([
                'role_id' => 4
                ]);

            $student = User::query()
                ->where('email', $row['email'])->first();
//            dd($student->id);
            $userClass = new User_Class();
            $userClass->user_id = $student->id;
            $userClass->class_id = $class->id;
//            dd($userClass->get());
            $userClass->save();
        }
        flash()->success('Upload thanh cong');
        return redirect()->route('admin.classes.index');
    }

    public  function addUser()
    {
        $courses = Course::all();
        $classes = Classes::all();
        return view('admin.classes.adduser',['classes'=>$classes,'courses'=>$courses]);
    }

    /**
     * @param AddUserStoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public  function  storeUser(AddUserStoreRequest $request)
    {

        $record = User::query()->where('email', $request->email)->first();
        if($record == null)
        {
            flash()->error('Email không tồn tại!');
            return redirect()->back();
        }
        else
        {
            $userId = $record->id;
            $class = new User_Class();
            $class->user_id = $userId;
            $class->class_id = $request->class;
            $user_class = User_Class::query()
                ->where('user_id','=',$record->id)
                ->where('class_id','=',$request->class)
                ->first();
            if($user_class !=null)
            {
                flash()->error('Học viên đã có trong lớp học!');
                return redirect()->back();
            }
            $classes = Classes::query()->where('id','=',$request->class)->first();

            $course = Course::query()->where('id','=',$classes->course_id)->first();

            $user_course = User_Course::query()
                ->where('user_id','=',$record->id)
                ->where('course_id','=',$course->id)
                ->first();
            if($user_course == null)
            {
                flash()->error('Học viên phải đóng tiền trước khi tham gia lớp học!');
                return redirect()->back();
            }

            if($class->save()){
                flash()->success('Them tai khoan thanh cong');
                return redirect()->route('admin.classes.show',$request->class);
            }
            else{
                flash()->error('Them tai khoan that bai');
                return redirect()->back();
            }
        }
    }

}
