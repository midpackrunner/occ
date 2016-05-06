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
     * Must register the middleware in Kernel.php
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $request allows for accessing characteristics
        // of the request

        if ( $request->user()->isAnAdmin()) {
            return redirect('login');
        } 
        

        return $next($request);  //<- Always return the request to the next stage
                                 //You can think of middleware as pipeline
    }
}
