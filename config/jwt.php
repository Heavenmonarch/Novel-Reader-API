<?php

return [
    'secret' => env('JWT_SECRET'),
    'algo' => env('JWT_ALGORITHM', 'HS256'),
    'access_ttl' => (int) env('JWT_ACCESS_TTL', 3600),
    'refresh_ttl' => (int) env('JWT_REFRESH_TTL', 2592000),
    'issuer' => env('APP_URL', 'http://localhost:8000'),
];