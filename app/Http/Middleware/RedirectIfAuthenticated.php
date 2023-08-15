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

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::user()->getRoleNames()[0] == 'admin') {
                    return redirect(RouteServiceProvider::HOME_ADMIN);
                } else if(Auth::user()->getRoleNames()[0] == 'petugas') {
                    return redirect(RouteServiceProvider::HOME_PETUGAS);
                } else if(Auth::user()->getRoleNames()[0] == 'member') {
                    return redirect(RouteServiceProvider::HOME_MEMBER);
                } else {
                    return redirect('/');
                }
            }
        }

        return $next($request);
    }
}
