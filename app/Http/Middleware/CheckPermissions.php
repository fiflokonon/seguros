<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $permission): Response
    {
        #dd(auth()->user()->permissionCodes());
        if (auth()->check() && !auth()->user()->canDo($permission)) {
            return redirect()->route('error-forbidden');
        }
        return $next($request);
    }
}
