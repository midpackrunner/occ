<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class PetOwnerAuthorization
{
    /**
     * Handle an incoming request for Pet info.
     * Only admin and the owner of a pet can
     * access the info pertaining to one particular
     * pet.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (Auth::user()->isAdmin()) {  // check if admin
            return $next($request);
        }

        $flag = false;                  // else


        $pet_id = explode('/', $request->getRequestUri());
        if (count($pet_id) > 2) {       // edit, show, or delete
            $pet_id = $pet_id[2];
        } else {
            return $next($request);     // create request
        }
        if($pet_id == "create") return $next($request);
        $usr_pets = Auth::user()->pets;
        foreach ($usr_pets as $pet) {
            if ($pet->id == $pet_id) {
                $flag = true;
            }
        }

        if ($flag) {
            return $next($request);
        }
        return redirect('/');
    }
}
