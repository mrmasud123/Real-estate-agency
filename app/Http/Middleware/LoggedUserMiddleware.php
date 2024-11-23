<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoggedUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if(Auth::check()) {
            $loggedUserData=Auth::user();
            if($loggedUserData->role !=='admin'){
                return response()->json([
                    'loggedUserData' => $loggedUserData,
                ]);
            }
            // return $data;
        }

        return $next($request);
    }
}
