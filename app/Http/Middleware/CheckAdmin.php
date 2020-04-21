<?php

namespace App\Http\Middleware;

use Closure;
use Auth; 

class CheckAdmin
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
        $userRoles = Auth::user()->roles->pluck('nomR');
        if(!$userRoles->contains('admin')){
            return redirect('accesrefuse');
        }
        return $next($request);
    }
}
