<?php

namespace App\Http\Middleware;

use Closure;

class Locale
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
        if (!session ()->has ('locale')) {
            session (['locale' => $request->getPreferredLanguage (config ('app.languages'))]);
        }
        $locale = session ('locale');
        app ()->setLocale ($locale);
        $locales = array_flip(config('app.languages'));
        setlocale (LC_TIME, app()->environment('local') ? $locale : $locales[$locale][1]);
        return $next ($request);
    }
}
