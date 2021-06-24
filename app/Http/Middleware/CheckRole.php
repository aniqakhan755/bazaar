<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if(Auth::check())
        {
            $user = Auth::user();

            $role_name = "";
            if (count($user->roles) > 0) {
                $role_name = $user->roles[0]->slug;

                if ($role_name == 'vendor') {
                    Session::put('role', 'vendor');
                }
            }
            else{
                Session::put('role', 'admin');

            }
        }

        return $next($request);
    }
}
