<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateSecretKey
{
    public function handle($request, Closure $next)
    {
        $secret = $request->header('Authorization');
        if (is_null($secret) == true) {
            return response()->json([
                'success' => false,
                'message' => 'This resource needs to be authenticated'
            ], 401);
        }
        return $next($request);
    }
}
