<?php

namespace Usmon\Microcore\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header('Accept-Language');
        $application_languages = config('locale.languages', 'null');
        // Adjust this part based on your supported languages
        if (in_array($locale, $application_languages ?? [])) {
            App::setLocale($locale);
        } else {
            // Default to a fallback language if none of the specified languages are found
            App::setLocale('en');
        }

        return $next($request);
    }
}
