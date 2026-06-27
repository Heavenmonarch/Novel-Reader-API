<?php

namespace App\Swagger\Schemas\Requests\Auth;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RegisterRequest',
    required: ['email', 'password', 'password_confirmation', 'username'],
    properties: [
        new OA\Property(property: 'email',                 type: 'string', format: 'email',    example: 'user@booknest.com'),
        new OA\Property(property: 'password',              type: 'string', format: 'password', example: 'password123'),
        new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'password123'),
        new OA\Property(property: 'username',              type: 'string',                     example: 'user12'),
        new OA\Property(property: 'role',                  type: 'string', enum: ['reader', 'author'], example: 'reader'),
        new OA\Property(property: 'genre_preference',      type: 'string', example: 'fantasy'),
    ]
)]
class RegisterRequest {}
