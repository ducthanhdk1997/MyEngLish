<?php

namespace App\Http\Controllers\Admin;
use App\Class_Course;
use App\Class_Exercise;
use App\Course;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Classes;
use App\PI_Amount;
use function Sodium\compare;


class ClassController extends Controller
{
    //
    function __construct()
    {
        parent::__construct();
    }

    public function getList()
    {
        $class_courses = Class_Course::all();
        $courses = Course::all();
    	return view('admin.classes.list',['class_courses'=>$class_courses,'courses'=>$courses]);
    }

    public function add()
    {
        $courses = Course::all();
        return view('admin.classes.add',['courses'=>$courses]);
    }
    public function addUser()
    {
        return view('admin.classes.adduser');
    }

    public  function  postClass(ClassStoreRequest $request, Classes $classes)
    {
        $classes->name=$request->name;
        $classes->grade_id = $request->grade_id;
        if($classes->save())
        {
            $class_id = Classes::where('name',$request->name)->value('id');
            $course = Class_Course::create([
                'class_id'=>$class_id,
                'course_id'=>$request->course_id
            ]);
            flash()->success('Thêm lớp thành công');
            return redirect()->route('admin.class.list');
        }
        else
        {
            flash()->error('Thêm thất bại');
        }
    }

    public function getClass(Classes $class)
    {
        return view('admin.classes.edit',compact('class'));
    }

    public function setName(ClassStoreRequest $request, Classes $classes)
    {
        $classes->name = $request->name;
        if($classes->save()){
            flash()->success('sua thanh cong');
            return redirect()->route('admin.class.list');
        }
        else{
            flash()->error('sua that bai');
        }
    }
}
