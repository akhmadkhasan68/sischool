<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class AdminMiddleware
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
        if(Auth::user()->level == 'ADMIN' && Auth::user()->si_masterdata == 1)
        {
            return $next($request);    
        }

        return abort(503, 'Anda tidak memiliki hak akses');
    }
}
