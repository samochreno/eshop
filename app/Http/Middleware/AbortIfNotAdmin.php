<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AbortIfNotAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return abort(401);
        }

        if (!auth()->user()->is_admin) {
            return abort(401);
        }

        return $next($request);
    }
}
