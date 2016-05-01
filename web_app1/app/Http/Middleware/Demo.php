<?php

namespace App\Http\Middleware;

use Closure;

class Demo
{
    /**
     * Handle an incoming request.
     * 
     * WATCH OUT FOR LOOOPS
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $request allows for accessing characteristics
        // of the request

        if($request->has('foo')) {
            return redirect('home');
        }

        return $next($request);  //<- Always return the request to the next stage
                                 //You can think of middleware as pipeline
    }
}
