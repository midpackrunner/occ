<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class AdminOrInstructorAuthorization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->isAdmin() || Auth::user()->isInstructor()) {
            return $next($request);
        }
        return redirect('/');
    }
}
