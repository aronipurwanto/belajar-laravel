<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SampleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey == 'XYZ'){
            return $next($request);
        }

        return response('Access Denied', 401);
    }
     */

    public function handle(Request $request, Closure $next, string $key, int $status): Response
    {
        $apiKey = $request->header('X-API-KEY');
        if ($apiKey == $key){
            return $next($request);
        }

        return response('Access Denied', $status);
    }
}
