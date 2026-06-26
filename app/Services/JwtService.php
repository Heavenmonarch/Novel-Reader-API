<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use App\Models\User;
use stdClass;

class JwtService
{
    private string $secret;
    private string $algo;
    private int $accessTtl;
    private int $refreshTtl;
    private string $issuer;


    public function __construct()
    {
        $this->secret = config('jwt.secret');
        $this->algo = config('jwt.algo');
        $this->accessTtl =config('jwt.access_ttl');
        $this->refreshTtl = config('jwt.refresh_ttl');
        $this->issuer = config('jwt.issuer');
    }


    public function generateAccessToken(User $user): string 
    {
        $now = time();

        $payload = [
            'iss' => $this->issuer,
            'sub' => (string) $user->id,
            'iat' => $now,
            'exp' => $Now + $this->accessTtl,
            'type' => 'access',
            'role' => $user->role
        ];

        return JWT::encode($payload, $this->secret, $this->algo);
    }


    public function generateRefreshToken (User $user): string 
    {
        $now = time();

        $payload = [
            'iss' => $this->issuer,
            'sub' => (string) $user->id,
            'iat' => $now,
            'exp' => $now + $this->refreshTtl,
            'type' => 'refresh'
        ];

        return JWT::encode($payload, $this->secret, $this->algo);
    }

    public function generateTokenPair(User $user): array
    {
        return [
            'access_token' => $this->generateAccessToken($user),
            'refresh_token' => $this->generateRefreshToken($user),
            'token_type' => 'Bearer',
            'expires_in' => $this->accessTtl
        ];
    }

    // Token Verification

    public function verifyAccessToken(string $token): stdClass|null
    {
        return $this->decode($token, 'access');
    }

    public function verifyRefreshToken(string $token): stdClass|null
    {
        return $this->decode($token, 'refresh');
    }

    public function decode (string $token, string $expectedType): stdClass|null
    {
        try {
            $decoded = JWT::decode($token, new Key($this->secret, $this->algo));

            if (($decoded->type ?? '') !== expectedType) {
                return null;
            }

            return $decoded;
        } catch (ExpiredException) {
            return null;
        } catch (SignatureInvalidException) {
            return null;
        } catch (\Exception) {
            return null;
        }
    }


    public function getUserFromToken(string $token): User|null
    {
        $decoded = $this->verifyAccessToken($token);

        if (!$decoded) {
            return null;
        }

        return User::find((int) $decoded->sub);
    }



}