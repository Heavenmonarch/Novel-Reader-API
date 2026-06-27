<?php

namespace App\Swagger\Annotations\Auth;

use OpenApi\Attributes as OA;

class AuthControllerDocs
{
    #[OA\Post(
        path: '/auth/register',
        summary: 'Register a new user',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/RegisterRequest')
        ),
        responses: [
            new OA\Response(response: 201, description: 'Account created successfully', content: new OA\JsonContent(ref: '#/components/schemas/TokenResponse')),
            new OA\Response(response: 422, description: 'Validation failed'),
        ]
    )]
    public function register(): void {}

    #[OA\Post(
        path: '/auth/login',
        summary: 'Login with email and password',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/LoginRequest')
        ),
        responses: [
            new OA\Response(response: 200, description: 'Login successful',    content: new OA\JsonContent(ref: '#/components/schemas/TokenResponse')),
            new OA\Response(response: 422, description: 'Invalid credentials'),
        ]
    )]
    public function login(): void {}

    #[OA\Post(
        path: '/auth/refresh',
        summary: 'Refresh access token',
        tags: ['Auth'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/RefreshTokenRequest')
        ),
        responses: [
            new OA\Response(response: 200, description: 'Token refreshed',       content: new OA\JsonContent(ref: '#/components/schemas/TokenResponse')),
            new OA\Response(response: 422, description: 'Invalid refresh token'),
        ]
    )]
    public function refresh(): void {}

    #[OA\Get(
        path: '/me',
        summary: 'Get the authenticated user',
        tags: ['Auth'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Authenticated user', content: new OA\JsonContent(ref: '#/components/schemas/UserResponse')),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function me(): void {}
}
