<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\UserStoreRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->where('role_id', '!=', 4)->groupBy('id')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(\Auth::user()->role_id == 1){
            $roles = Role::all();
            return view('admin.users.create', compact('roles'));
        }
        return redirect()->route('admin.index');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = new User();
        $user->username = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->role_id = $request->role;
        if (strlen($request->password) > 0){
            $user->password = bcrypt($request->password);
        }
        else{
            $user->password = bcrypt('secret');
        }
        if($user->save()){
            flash()->success('Thêm người dùng thành công');
            return redirect()->route('admin.users.index');
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
    public function show(User $user)
    {
        return view('admin.users.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserStoreRequest $request, User $user)
    {
        $user->username = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->gender = $request->gender == "on" ? 1 : 0;

        if ($user->save()){
            flash()->success('Thay đổi thành công');
        }
        else{
            flash()->error('Thay đổi thất bại');
        }
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if($user->delete()){
            flash()->success('Xoa thanh cong');
        }
        else{
            flash()->error('Xoa that bai');
        }
        return redirect()->back();
    }

    public function search(UserStoreRequest $request){

        $key = $request->key;
        $users = User::query()
            ->where('username',  'like', "%$key%")
            ->paginate(10);
        return view('admin.users.search', compact('users', 'key'));
    }

}
