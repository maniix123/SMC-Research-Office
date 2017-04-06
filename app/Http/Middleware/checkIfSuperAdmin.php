<?php

namespace App\Http\Middleware;

use Closure;

class checkIfSuperAdmin
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
       if($request->user()->role == 'Super Admin')
        {
            return $next($request);
        }
        abort(401);
    }
}
