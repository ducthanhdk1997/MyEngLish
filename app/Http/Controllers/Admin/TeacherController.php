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
        $user->avatar = 'image.jpg';
        $user->level = $request->level;
        $user->facebook = '';
        if (strlen($request->password) > 0){
            $user->password = bcrypt ($request->password);
        }
        else{
            $user->password = bcrypt ('abc123');
        }
        if($user->save()){
            flash()->success('Thêm người dùng thành công');
            return redirect()->route('admin.teachers.index');
        }
        else{
            flash()->error('Thêm ngời dùng thất bại');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


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
    public function update(Request $request, User $teacher)
    {
        $teacher->level = $request->level;
        if ($teacher->save()){
            flash()->success('Thay đổi thành công');
        }
        else{
            flash()->error('Thay đổi thất bại');
        }
        return redirect()->route('admin.teachers.index');
    }




}
