<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    public function handle($request, Closure $next)
    {
        $allowed = ['en', 'fr', 'ar'];

        $localeFromParam = $request->query('lang');

        if (in_array($localeFromParam, $allowed)) {
            // Valid → save & use it
            Session::put('locale', $localeFromParam);
            $locale = $localeFromParam;
        } else {
            // ❗ Invalid (like en, es, null, etc.)
            // Always fallback to FR
            $locale = Session::get('locale');

            if (!in_array($locale, $allowed)) {
                $locale = 'fr';
                Session::put('locale', 'fr'); // optional but recommended
            }
        }

        App::setLocale($locale);

        return $next($request);
    }
}
