<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(protected JwtService $jwt) {}

    public function register(array $data): array
    {
        $user = User::create([
            'email'            => $data['email'],
            'password'         => $data['password'],
            'username'         => $data['username'],
            'role'             => $data['role'] ?? 'reader',
            'genre_preference' => $data['genre_preference'] ?? null,
        ]);

        return $this->jwt->generateTokenPair($user);
    }

    public function login(array $data): array
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['These credentials do not match our records.'],
            ]);
        }

        if (!$user->is_active) {
            throw ValidationException::withMessages([
                'email' => ['Your account has been suspended.'],
            ]);
        }

        return $this->jwt->generateTokenPair($user);
    }

    public function refresh(string $refreshToken): array
    {
        $decoded = $this->jwt->verifyRefreshToken($refreshToken);

        if (!$decoded) {
            throw ValidationException::withMessages([
                'refresh_token' => ['The refresh token is invalid.'],
            ]);
        }

        $user = User::find((int) $decoded->sub);

        if (!$user || !$user->is_active) {
            throw ValidationException::withMessages([
                'refresh_token' => ['User not found or is suspended.'],
            ]);
        }

        return $this->jwt->generateTokenPair($user);
    }
}
