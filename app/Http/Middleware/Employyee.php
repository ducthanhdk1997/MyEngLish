<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Employyee
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
            $role_id = Auth::user()->role_id;
            if($role_id == 2)
            {
                return $next($request);
            }
        }
        else
        {
            return redirect()->route('getLogin');
        }

        return abort(404);
    }
}
