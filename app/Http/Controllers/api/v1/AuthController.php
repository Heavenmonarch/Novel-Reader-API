<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $tokens = $this->authService->register($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Account created successfully.',
            'data'    => $tokens,
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $tokens = $this->authService->login($request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Login successful.',
            'data'    => $tokens,
        ]);
    }

    public function refresh(RefreshTokenRequest $request): JsonResponse
    {
        $tokens = $this->authService->refresh($request->refresh_token);

        return response()->json([
            'status'  => 'success',
            'message' => 'Token refreshed.',
            'data'    => $tokens,
        ]);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data'   => $request->user(),
        ]);
    }
}
