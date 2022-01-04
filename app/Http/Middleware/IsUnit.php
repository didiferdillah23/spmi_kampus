<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsUnit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (session()->get('info_login')->level == "unit") {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
