<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AgreeConsent
{
    public function handle(Request $request, Closure $next): RedirectResponse|Response
    {
        if (Auth::user()->consent()) {
            return $next($request);
        }
        redirect(route('consent'));
    }
}
