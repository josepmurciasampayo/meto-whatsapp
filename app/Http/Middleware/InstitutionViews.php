<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class InstitutionViews
{
    public function handle(Request $request, Closure $next): RedirectResponse
    {
        if (auth()->user()->isInstitution()) {
            return $next($request);
        }
        return redirect(route('home'));
    }
}
