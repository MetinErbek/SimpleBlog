<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $roleMappings = [
            'admin' => 1,
            'moderator' => 2,
            'writer' => 3,
            'reader' => 4,
        ];
    

        if ($request->is('api*')) {

            if (Auth::check() && in_array(Auth::user()->role_id, array_map(fn ($role) => $roleMappings[$role], $roles))) {
                return $next($request);
            } else {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        }
    

        if (Auth::check() && in_array(Auth::user()->role_id, array_map(fn ($role) => $roleMappings[$role], $roles))) {
            return $next($request);
        }
    

        abort(403, 'Unauthorized');
    }
}
