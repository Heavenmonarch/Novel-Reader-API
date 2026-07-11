<?php

namespace App\Swagger\Schemas\Requests\Book;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'CreateBookRequest',
    required: ['title', 'synopsis', 'genre_id'],
    properties: [
        new OA\Property(property: 'title',          type: 'string',  example: 'The Last Dragon'),
        new OA\Property(property: 'synopsis',       type: 'string',  example: 'A story about the last dragon in a dying world...'),
        new OA\Property(property: 'genre_id',       type: 'integer', example: 1),
        new OA\Property(
            property: 'tags',
            type: 'array',
            items: new OA\Items(type: 'integer', example: 3)
        ),
        new OA\Property(property: 'content_rating', type: 'string',  enum: ['everyone', 'teen', 'mature'], example: 'teen'),
        new OA\Property(property: 'cover_image',    type: 'string',  example: 'https://cloudinary.com/cover.jpg'),
    ]
)]
class CreateBookRequest {}
