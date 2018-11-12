<?php

namespace App\Http\Controllers\Admin;

use App\Classes;
use App\User;
use App\User_Class;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::query()->paginate(10);
        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        return view('admin.classes.detail', compact('usersClass'));
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
//        dd($teachers);
        return view('admin.classes.edit', compact('class', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classes $class)
    {
        $class->name = $request->name;
        $class->user_id = $request->teacher;

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
}
