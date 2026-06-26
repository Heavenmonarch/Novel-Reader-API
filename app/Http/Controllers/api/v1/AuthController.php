<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        $tokens = AuthService::register($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Account created successfully',
            'data' => [$tokens],
        ], 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $tokens = AuthService::login($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => $tokens,
        ]);
    }

    public function refresh(RefreshTokenRequest $request): JsonResponse
    {
        $data = $request->validated();
        $tokens = AuthService::refresh($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Token refreshed.',
            'data' => $tokens,
        ]);
    }

    public function me (Request $request): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $request->user(),
        ]);
    }
}
