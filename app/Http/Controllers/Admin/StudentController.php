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

    public function index()
    {
        $users = User::query()->where('role_id','=',  4)->paginate(10);
        return view('admin.students.index', compact('users'));
    }


    public function create()
    {
        $courses = Course::all();
        $classes = Classes::all();
        return view('admin.students.create', ['classes'=>$classes,'courses'=>$courses]);



    }


     public function detail(User $user)
     {
         return view('admin.students.detail',['user' => $user]);
     }

    public function store(UserStoreRequest $request)
    {

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender == 'on' ? 1 : 0;
        $user->role_id = 4;
        $user->address = '';
        $user->avatar = 'image.jpg';
        $user->level = 'Học viên';
        $user->facebook = '';
        if (strlen($request->password) > 0){
            $user->password = bcrypt ($request->password);
        }
        else{
            $user->password = bcrypt ('abc123');
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


}
