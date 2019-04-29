<?php

namespace App\Http\Controllers\Admin;

use App\Classes;
use App\Course;
use App\Http\Requests\Admin\StudentStoreRequest;
use App\Http\Requests\Admin\StudentUpdateRequest;
use App\Http\Requests\Admin\UserStoreRequest;
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
        $courses = Course::all();
        $classes = Classes::all();
        return view('admin.students.create', ['classes'=>$classes,'courses'=>$courses]);



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UserStoreRequest $request)
    {

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender == 'on' ? 1 : 0;
        $user->role_id = 4;
        $user->address = '';
        $user->level = 'Học viên';
        $user->facebook = '';
        if (strlen($request->password) > 0){
            $user->password = bcrypt($request->password);
        }
        else{
            $user->password = bcrypt('secret');
        }

        if($user->save()){
            flash()->success('Them tai khoan thanh cong');
            return redirect()->route('admin.students.index');
        }
        else{
            flash()->error('Them tai khoan that bai');
            return redirect()->route('admin.students.index');
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
    public function update(StudentUpdateRequest $request, User $user)
    {
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender == "on" ? 1 : 0;
        $user->level = $request->level;
        $user->address = $request->address;
        $user->facebook = $request->facebook;
        if (strlen($request->password) > 0){
            $user->password = bcrypt($request->password);
        }
        else{
            $user->password = bcrypt('secret');
        }

        if ($user->save()){
            flash()->success('Thay đổi thành công');
        }
        else{
            flash()->error('Thay đổi thất bại');
        }
        return redirect()->route('admin.teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            flash()->success('Bạn đã xóa tài khoản thành công');
        }
        else{
            flash()->error('Bạn đã xóa tài khoản thất bại');
        }
        return redirect()->route('admin.students.index');
    }

    public function search(Request $request){
        $key = $request->key;
//        dd($request->search);
        $users = User::query()
            ->where('username', 'like', "%$key%")
            ->where('role_id', 'like', 4)
            ->paginate(10);
        return view('admin.students.search', compact('users', 'key'));
    }
}
