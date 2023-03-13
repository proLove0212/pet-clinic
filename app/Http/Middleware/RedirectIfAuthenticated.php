<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        if($request->is("petcrew/admin_page/login") || $request->is("petcrew/login")){
            return $next($request);
        }

        foreach ($guards as $guard) {

            if ($guard == "admin" && Auth::guard($guard)->check()) {
                return redirect(route('admin.users'));
            }

            if (Auth::guard($guard)->check()) {
                return redirect(route('user.search'));
            }
        }

        return $next($request);
    }
}
