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
            return redirect()->route('home');
        }
        else{
            flash()->error('Ten tai khoan hoac mat khau khong dung');
            return redirect()->route('getLogin');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
