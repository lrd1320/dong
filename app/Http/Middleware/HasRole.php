<?php

namespace App\Http\Middleware;

use Closure;

class HasRole
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
//        获取当前路由

        $route = \Route::current()->getActionName();
        dd($route);

        return $next($request);
    }
}
