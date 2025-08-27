<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaticApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken() ?? $request->header('X-API-Token') ?? $request->query('api_token');
        $validToken = config('app.api_token'); 

        if (!$token || $token !== $validToken) {
            return response()->json([
                'error' => 'Invalid API token'
            ], 401);
        }

        return $next($request);
    }
}