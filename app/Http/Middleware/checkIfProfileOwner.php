<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class checkIfProfileOwner
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
        if($request->id == Auth::id() || Auth::user()->role == 'Super Admin')
        {
            return $next($request);
        }
        return redirect('Admin/Profile/' .$request->id)->with('message', 'YOU CANNOT EDIT SOMEONE ELSES PROFILE!'); 
    }
}
