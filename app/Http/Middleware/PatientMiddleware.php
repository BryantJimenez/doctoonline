<?php

namespace App\Http\Middleware;

use Closure;

class PatientMiddleware
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
        if ($request->session()->has('user') && session('user')[0]->type==2) {
            return $next($request);
        }
        
        abort(403);
    }
}
