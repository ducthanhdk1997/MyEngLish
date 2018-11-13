<?php

namespace App\Http\Controllers\Admin;

use App\Classes;
use App\Course;
use App\Http\Requests\Admin\ClassStoreRequest;
use App\User;
use App\User_Class;
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
        $courses = Course::all();
        $teachers = User::query()
            ->where('role_id',4)
            ->get();
        return view('admin.classes.add', compact('courses', 'teachers'));
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
        $class->user_id = $request->teacher;
        $class->grade_id = $request->grade_id;
        if($class->save()){
            flash()->success('Tạo lớp học thành công');
            return redirect()->route('admin.classes.index');
        }
        else{
            flash()->error('Tạo lớp thất bại');
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

        return view('admin.classes.detail', compact('usersClass', 'class'));
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

}
