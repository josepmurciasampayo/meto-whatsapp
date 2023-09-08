<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstitutionViews
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->isInstitution()) {
            return $next($request);
        }
        return redirect(route('home'));
    }
}
