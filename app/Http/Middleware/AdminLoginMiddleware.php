<?php

namespace App\Http\Middleware;

use App\Role;
use App\User_Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            $user_role = User_Role::where('user_id',1)->first();
            $role = Role::where('id',$user_role->role_id)->first();
            if($role->name=="Giảng viên" || $role->name=="Trợ giảng" || $role->name == "admin")
            {
                return $next($request);
            }
            else
            {
                return redirect('login');
            }
        }
        else{
            return redirect('login');
        }

    }
}
