<?php

namespace App\Swagger\Schemas\Requests\Auth;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RefreshTokenRequest',
    required: ['refresh_token'],
    properties: [
        new OA\Property(property: 'refresh_token', type: 'string', example: 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...'),
    ]
)]
class RefreshTokenRequest {}
