<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
//use Auth ;
//return Auth::user();
class CheckAge
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

        //get the Age of user

        $Age= Auth::user()->Age;
        //Check login
        if ($Age < 20){
            //return redirect('home');
            return redirect('notAllowed');
            //return "Not Allowed";
        }
        return $next($request);
    }
}
