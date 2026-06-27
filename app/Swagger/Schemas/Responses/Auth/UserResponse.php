<?php

namespace App\Swagger\Schemas\Responses\Auth;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UserResponse',
    properties: [
        new OA\Property(property: 'status', type: 'string', example: 'success'),
        new OA\Property(
            property: 'data',
            type: 'object',
            properties: [
                new OA\Property(property: 'id',               type: 'integer', example: 1),
                new OA\Property(property: 'email',            type: 'string',  example: 'ayanfe@booknest.com'),
                new OA\Property(property: 'username',         type: 'string',  example: 'ayanfe'),
                new OA\Property(property: 'display_name',     type: 'string',  example: 'Ayanfe'),
                new OA\Property(property: 'avatar',           type: 'string',  example: 'https://cloudinary.com/avatar.jpg'),
                new OA\Property(property: 'role',             type: 'string',  example: 'author'),
                new OA\Property(property: 'genre_preference', type: 'string',  example: 'fantasy'),
            ]
        ),
    ]
)]
class UserResponse {}
