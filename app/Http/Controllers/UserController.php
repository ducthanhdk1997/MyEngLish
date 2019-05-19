<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StudentUpdateRequest;
use App\User;
use Carbon\Carbon;
use Hash;
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

    public function profile(User $user)
    {
        if($user->id != Auth::user()->id)
        {
            return abort(404);
        }
        return view('pages.profile',['user' => $user]);
    }

    public function update(StudentUpdateRequest $request, User $user)
    {


        if($user->id != Auth::user()->id)
        {
            return abort(404);
        }
        $date = Carbon::now()->toDateString();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender == "on" ? 1 : 0;
        $user->address = $request->address;

        $destinationPath = '';
        if ($request->hasFile('avatar')){

            $this->validate($request, [
                'avatar' => 'image|max:2028',
            ]);

            $file = $request->avatar;
            $file_name = md5($file->getClientOriginalName()).$date.$user->id;
            $extention = $file->getClientOriginalExtension();
            $destinationPath = public_path('upload');

            $file->move($destinationPath,$file_name.'.'.$extention);
            $user->avatar = $file_name.'.'.$extention;
        }
        if (strlen($request->new_password) > 0){

            if($request->new_password != $request->renew_password)
            {
                flash()->error('Nhập lại mật khẩu sai!');
                return redirect()->back();
            }
            if (!Hash::check($request->old_password, $user->password))
            {
                // The passwords match...
                flash()->error('Mật khẩu cũ không chính xác!');
                return redirect()->back();
            }

            $user->password = bcrypt($request->new_password);
        }

        if ($user->save()){
            flash()->success('Thay đổi thành công');
        }
        else{
            flash()->error('Thay đổi thất bại');
        }
        return redirect()->back();
    }
}
