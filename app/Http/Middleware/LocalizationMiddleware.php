<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Принудительно используем язык приложения по умолчанию (ru),
        // чтобы переводы и языковые файлы всегда брались из resources/lang/ru.
        App::setLocale(config('app.locale'));

        return $next($request);
    }
}
