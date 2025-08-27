<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->role === 'Admin') {
            return $next($request);
        }
        // Redirect based on role
        if ($user->role === 'Student') {
            return redirect()->route('student.dashboard');
        } elseif ($user->role === 'Others') {
            return redirect()->route(route: 'others.dashboard');
        }

        return redirect('/');
    }
}
