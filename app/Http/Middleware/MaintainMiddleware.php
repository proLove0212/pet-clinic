<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\MaintainLog;
use Carbon\Carbon;


class MaintainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $maintain = MaintainLog::whereDate("from", "<=", Carbon::now())
        ->whereDate("to", ">=", Carbon::now())->first();

        if($maintain){
            $request->session()->flush();

            return redirect('/maintain')->with('start_time', $maintain->from)->with("end_time", $maintain->to);
        }else{
            return $next($request);
        }
    }
}
