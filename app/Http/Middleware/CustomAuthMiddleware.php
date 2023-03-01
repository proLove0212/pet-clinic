<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class CustomAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $cur_role = $request->session()->get('role', 'customer');
        if($cur_role == $role){
            if($cur_role == "user"){
                $cid = $request->session()->get('ClinicID', 'default');
                $user = User::where("ClinicID", "=", $cid)->first();

                if($user){
                    if($user->CustStatus == 5){
                        return $next($request);
                    }else if($request->path() == "user/pwd_reset"){
                        return $next($request);
                    }else{
                        $request->session()->flush();
                        return redirect('/user/login');
                    }
                }else{
                    return redirect('/user/login');
                }
            }
            return $next($request);
        }else
            return redirect('/');
    }
}
