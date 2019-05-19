<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\EmployeeStoreRequest;
use App\Http\Requests\Admin\TeacherStoreRequest;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    //

    public function index()
    {
        $employees = User::query()->where('role_id','=',  2)->paginate(10);
        return view('admin.employee.index', ['employees' => $employees]);
    }


    public function create()
    {
        if(\Auth::user()->role_id == 1){
            $roles = Role::all();
            return view('admin.employee.create', compact('roles'));
        }
        return redirect()->route('admin.index');
    }

    public function destroy(User $employee)
    {
        if ($employee->delete()) {
            flash()->success('Xoa thanh cong');
        } else {
            flash()->error('Xoa that bai');
        }

        return redirect()->back();
    }



    public function detail(User $user)
    {
        return view('admin.employee.detail',['user' => $user]);
    }

    public function store(EmployeeStoreRequest $request)
    {

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender == 'on' ? 1 : 0;
        $user->role_id = 2;
        $user->address = '';
        $user->avatar = 'image.jpg';
        $user->level = '';
        $user->facebook = '';
        if (strlen($request->password) > 0){
            $user->password = bcrypt ($request->password);
        }
        else{
            $user->password = bcrypt ('abc123');
        }

        if($user->save()){
            flash()->success('Them tai khoan thanh cong');
            return redirect()->route('admin.employee.index');
        }
        else{
            flash()->error('Them tai khoan that bai');
            return redirect()->route('admin.employee.index');
        }
    }
}
