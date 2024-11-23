<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  $role
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }
        $user = Auth::user();
        if ($user->role !== $role) {
            return redirect()->route('user.login')->with(['message'=>'Unauthorize access','alert-type'=>'error']);
        }

        return $next($request);
    }
}


?>