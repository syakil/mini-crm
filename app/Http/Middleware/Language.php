<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class Language
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
        if (session()->has('locale')) {
            \App::setlocale(session()->get('locale'));
        }
        return $next($request);
    }
}
