<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\StudentStoreRequest;
use App\Http\Requests\Admin\TeacherStoreRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\TeacherUpdateRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use phpDocumentor\Reflection\DocBlock;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = User::query()->where('role_id',  3)->paginate(10);
        return view('admin.teachers.index',['teachers'=>$teachers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->role_id == 1 || \Auth::user()->role_id == 2){
            $roles = Role::all();
            return view('admin.teachers.create', compact('roles'));
        }
        return redirect()->route('admin.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherStoreRequest $request)
    {
        $user = new User();
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = '';
        $user->gender = $request->gender == 'on' ? 1 : 0;
        $user->role_id = 3;
        $user->level = $request->level;
        $user->facebook = '';
        if (strlen($request->password) > 0){
            $user->password = bcrypt($request->password);
        }
        else{
            $user->password = bcrypt('secret');
        }
        if($user->save()){
            flash()->success('Thêm người dùng thành công');
            return redirect()->route('admin.teachers.index');
        }
        else{
            flash()->error('Thêm ngời dùng thất bại');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $teacher)
    {
        return view('admin.teachers.detail', ['teacher'=>$teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(User $teacher)
    {
        return view('admin.teachers.edit', ['teacher'=>$teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TeacherUpdateRequest $request
     * @param User $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherUpdateRequest $request, User $teacher)
    {
        $teacher->username = $request->username;
        $teacher->email = $request->email;
        $teacher->phone = $request->phone;
        $teacher->gender = $request->gender == "on" ? 1 : 0;
        $teacher->level = $request->level;
        $teacher->address = $request->address;
        $teacher->facebook = $request->facebook;
        if (strlen($request->password) > 0){
            $teacher->password = bcrypt($request->password);
        }
        else{
            $teacher->password = bcrypt('secret');
        }

        if ($teacher->save()){
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
    public function destroy(User $teacher)
    {
        if($teacher->delete()){
            flash()->success('Xoa thanh cong');
        }
        else{
            flash()->error('Xoa that bai');
        }
        return redirect()->back();
    }

    public function search(Request $request){
        $key = $request->key;
        $teachers = User::query()
            ->where('username',  'like', "%$key%")
            ->where('role_id',  '<>', 4)
            ->paginate(10);
        return view('admin.teachers.search', compact('teachers', 'key'));
    }

}
