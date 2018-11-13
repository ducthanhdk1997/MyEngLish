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
//        dd($request->email, $request->password);
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password])){
//            dd('hello');
            return redirect()->route('home');
        }
        else{
            return redirect()->route('getLogin')->withErrors('ádasd');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('getLogin');
    }
}
