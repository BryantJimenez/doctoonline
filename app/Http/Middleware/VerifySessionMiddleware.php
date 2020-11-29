<?php

namespace App\Http\Middleware;

use Closure;
use App\People;

class VerifySessionMiddleware
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
        if ($request->session()->has('user')) {
            $count=People::where('id', session('user')[0]->id)->count();
            if ($count==0) {
                $request->session()->forget('user');
            }
        }
        return $next($request);
    }
}
