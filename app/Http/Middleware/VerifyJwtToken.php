<?php

namespace App\Http\Middleware;

use App\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyJwtToken
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */

    public function __construct(protected JwtService $jwt) {}
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'No authentication token provided.'
            ], 401);
        }

        $user = $this->jwt->getUserFromToken($token);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid or expired token.'
            ], 401);
        }

        if (!$user->is_active) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your account has been suspended.'
            ], 403);
        }

        $request->setUserResolver(fn() => $user);

        return $next($request);
    }
}
