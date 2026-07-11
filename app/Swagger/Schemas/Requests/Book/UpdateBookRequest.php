<?php

namespace App\Swagger\Schemas\Requests\Book;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UpdateBookRequest',
    properties: [
        new OA\Property(property: 'synopsis',       type: 'string',  example: 'An updated synopsis...'),
        new OA\Property(property: 'genre_id',       type: 'integer', example: 2),
        new OA\Property(
            property: 'tags',
            type: 'array',
            items: new OA\Items(type: 'integer', example: 3)
        ),
        new OA\Property(property: 'content_rating', type: 'string',  enum: ['everyone', 'teen', 'mature'], example: 'mature'),
        new OA\Property(property: 'cover_image',    type: 'string',  example: 'https://cloudinary.com/newcover.jpg'),
    ]
)]
class UpdateBookRequest {}
