<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CounselorViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth()->user()->isCounselor()) {
            return $next($request);
        }
        return redirect('errors/403', 403);
    }
}
