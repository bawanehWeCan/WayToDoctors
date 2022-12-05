<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeLang
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

        $lang = ($request->hasHeader('X-localization')) ? $request->header('X-localization') : 'en';
        app()->setlocale($lang);
        return $next($request);
    }
}
