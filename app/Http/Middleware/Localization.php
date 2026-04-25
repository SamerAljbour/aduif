<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class Localization
{
    public function handle($request, Closure $next)
    {
        // ✅ Allowed languages
        $allowed = ['fr', 'ar'];

        // 1️⃣ Get from URL parameter: ?lang=fr
        $localeFromParam = $request->query('lang');

        if (in_array($localeFromParam, $allowed)) {
            // Save to session if valid
            Session::put('locale', $localeFromParam);
            $locale = $localeFromParam;
        } else {
            // 2️⃣ Fallback to session OR default (fr)
            $locale = Session::get('locale', config('app.locale'));
        }

        // 3️⃣ Apply language
        App::setLocale($locale);

        return $next($request);
    }
}
