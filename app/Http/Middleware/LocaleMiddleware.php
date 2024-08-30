<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->header('Accept-Language', 'en');
        $langs = config('app.languages');
        if(in_array($lang,$langs)){
            app()->setLocale($lang);
        }else{
            app()->setLocale('en');
        }
        return $next($request);
    }
}
