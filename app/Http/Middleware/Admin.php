<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class Admin
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
        $sw = false;
        foreach (Auth::user()->roles as $role) {
            if($role->pivot->role_id == 1){
                $sw = true;
            }
        }
        if (!$sw) {
            abort(403, 'No esta autorizado para ver este contenido');
        }
        return $next($request);
    }
}
