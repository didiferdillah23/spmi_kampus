<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAmi
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
        if (session()->get('info_login')->level == "ami") {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}
