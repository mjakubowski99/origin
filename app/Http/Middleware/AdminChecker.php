<?php

namespace App\Http\Middleware;

use Closure;

class AdminChecker
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
        if( $request->user() == null )
            return redirect('/login');

        $roles = $request->user()->roles;
        foreach( $roles as $role ){
            if( $role->name == 'admin')
                return $next($request);
        }

        return abort(404);
    }
}
