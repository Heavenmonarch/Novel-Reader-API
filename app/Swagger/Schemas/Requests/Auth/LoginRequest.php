<?php

namespace App\Swagger\Schemas\Requests\Auth;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'LoginRequest',
    required: ['email', 'password'],
    properties: [
        new OA\Property(property: 'email',    type: 'string', format: 'email',    example: 'user@booknest.com'),
        new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123'),
    ]
)]
class LoginRequest {}
