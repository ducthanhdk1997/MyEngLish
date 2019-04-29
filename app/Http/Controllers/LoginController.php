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
            if($role == 1 || $role == 2)
            {
                return redirect()->route('admin.home.index');
            }
            else
            {
                if($role == 4)
                {
                    return redirect()->route('student.exam.index');
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
