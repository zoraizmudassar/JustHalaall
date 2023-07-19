<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Restaurant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        dd(Auth::user()->status);
        if(Auth::check()){
//            dd(Auth::guard('restaurant')->user());
            if(Auth::user()->status == "approved"){
                return $next($request);
            }
            else{
                Auth::logout();
                return redirect()->route('restaurants.showLoginForm')->with('You Have not Approved Yet For Restaurant!');
            }

        }
    }
}
