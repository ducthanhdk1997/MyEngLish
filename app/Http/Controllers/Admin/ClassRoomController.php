<?php

namespace App\Http\Controllers\Admin;
use App\Classroom;
use App\Http\Controllers\Controller;

use App\Http\Requests\Admin\StoreClassRoomRequest;
use App\Http\Requests\Admin\UpdateClassRoomRequest;
use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    //
    function __construct()
    {
    }

    public  function index()
    {
        $classrooms = Classroom::all();
        return view('admin.classroom.index',['classrooms' => $classrooms]);
    }

    public  function  create()
    {
        return view('admin.classroom.create');
    }

    public  function store(StoreClassRoomRequest $request)
    {
        $name = $request->name;
        $classroom = new Classroom();
        $classroom->name = $name;
        if($classroom->save())
        {
            flash()->success('Thêm thành công!');
            return redirect()->route('admin.classroom.index');
        }
        else
        {
            flash()->error('Thêm thất bại!');
            return redirect()->back();
        }
    }

    public function edit(Classroom $classroom)
    {
        return view('admin.classroom.edit',['classroom' => $classroom]);
    }

    public function update(UpdateClassRoomRequest $request,Classroom $classroom)
    {
        $name = $request->name;

        $classroom->name = $name;

        if($classroom->save())
        {
            flash()->success('Sửa thành công!');
            return redirect()->route('admin.classroom.index');
        }
        else
        {
            flash()->error('Sửa không thành công!');
            return redirect()->back();
        }
    }
}
