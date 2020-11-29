<?php

namespace App\Http\Middleware;

use Closure;

class SelectedTypeMiddleware
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
        if (!isset(session('user')[0]->type) || is_null(session('user')[0]->type) || session('user')[0]->type=="" || (session('user')[0]->type!=1 && session('user')[0]->type!=2)) {
            return redirect()->route('web.selected');
        } else {
            return $next($request);
        }
    }
}
