<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class StatusUser
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
        if (!Auth::user()->status) {
            Auth::logout();
            abort(403, 'Su usuario se encuentra desactivado, No tiene autorizacion para usar el sistema');
        }
        return $next($request);
    }
}
