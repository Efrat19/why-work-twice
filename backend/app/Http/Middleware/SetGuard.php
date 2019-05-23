<?php

namespace App\Http\Middleware;

use Closure;

class SetGuard
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
        if($request->expectsJson()){
            config(['auth.defaults.guard' => 'api']);
        }
        return $next($request);
    }
}
