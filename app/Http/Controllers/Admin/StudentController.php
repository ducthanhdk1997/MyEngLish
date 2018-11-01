<?php

namespace App\Http\Controllers\Admin;

use App\Classes;
use App\Http\Requests\Admin\StudentStoreRequest;
use App\User_Class;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->where('role_id','=',  4)->paginate(10);
        return view('admin.students.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::all();
        return view('admin.students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        $user = new User();
        $user->username = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender == 'on' ? 1 : 0;
        $user->role_id = 4;
        if (strlen($request->password) > 0){
            $user->password = bcrypt($request->password);
        }
        else{
            $user->password = bcrypt('secret');
        }
        if($user->save()){
            $record = User::query()->where('email', $request->email)->first();
            $userId = $record->id;
            $class = new User_Class();
            $class->user_id = $userId;
            $class->class_id = $request->class;
            if($class->save()){
                flash()->success('Them tai khoan thanh cong');
                return redirect()->route('admin.students.index');
            }
            else{
                flash()->error('Them tai khoan that bai');
            }
        }
        else{
            flash()->error('Them tai khoan that bai');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.students.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->username = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender == 'on' ? 1 : 0;
        if(strlen($request->password) > 0){
            $user->password = $request->password;
        }
        if ($user->save()){
            flash()->success('Thay đổi tài khoản thành công');
            return redirect()->route('admin.students.index');
        }
        else{
            flash()->error('Thay đổi thất bại');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
