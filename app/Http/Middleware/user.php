<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class user
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
        // dd($request);
        if (Auth::user() && $request->name==Auth::user()->name) {
            return $next($request);
        }

        return redirect()->back();
    }
}
