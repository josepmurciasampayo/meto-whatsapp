<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminViews
{
    public function handle(Request $request, Closure $next): RedirectResponse|\Illuminate\Http\Response
    {
        $user = Auth()->user();
        if (is_null($user)) {
            return redirect('login');
        }
        if ($user->isAdmin()) {
            return $next($request);
        }
        abort(403);
    }
}
