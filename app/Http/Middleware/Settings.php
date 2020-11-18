<?php

namespace App\Http\Middleware;

use Closure;

class Settings
{
    public function handle($request, Closure $next)
    {
        if (auth()->check()) {
            config(['app.pagination' => auth()->user()->pagination]);
        }

        return $next($request);
    }
}
