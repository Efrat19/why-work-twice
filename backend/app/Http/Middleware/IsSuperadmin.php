<?php

namespace App\Http\Middleware;

use Closure;

class IsSuperadmin
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
        if (auth('api')->user()->isSuperadmin()){
            return $next($request);
        }
        return abort(402);
    }
}