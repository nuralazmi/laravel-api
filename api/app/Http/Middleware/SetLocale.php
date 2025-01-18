<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $accept_language = $request->header('Accept-Language');
        $accept_language = $accept_language && in_array($accept_language, config('app.supported_languages')) ? $accept_language : App::getLocale();
        App::setLocale($accept_language);

        return $next($request);
    }
}
