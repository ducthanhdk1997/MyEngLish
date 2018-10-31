<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public  function  __construct()
    {
    }

    public  function  login(Request $request)
    {

        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required '=> 'Bạn chưa nhập email',
            'password.required' => 'Bạn chưa nhập password'
        ]);


        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email'=>$email,'password'=>$password]))
            return redirect('admin/grade/list');
        else
            return redirect('login')->with('message','Đăng nhập không thành công');
    }

    public  function  logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
