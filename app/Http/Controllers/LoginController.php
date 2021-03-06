<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function getLogin(){
        return view('login');
    }

    public function postLogin(Request $request){
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){

            $role = Auth::user()->role_id;
            if($role == 1)
            {
                return redirect()->route('admin.courses.index');
            }
            if($role == 2)
            {
                return redirect()->route('employee.home.index');
            }
            else
            {
                if($role == 3)
                {
                    return redirect()->route('teacher.class.index');
                }
                if($role == 4)
                {
                    return redirect()->route('student.course.index');
                }
            }
        }
        else{
            return redirect()->route('getLogin')->withErrors('Tên đăng nhập hoặc mật khẩu không chính xác!');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
