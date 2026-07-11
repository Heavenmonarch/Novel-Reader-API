<?php

namespace App\Swagger\Schemas\Responses\Book;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'BookListResponse',
    properties: [
        new OA\Property(property: 'status', type: 'string', example: 'success'),
        new OA\Property(
            property: 'data',
            type: 'object',
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/BookResponse')
                ),
                new OA\Property(property: 'current_page',   type: 'integer', example: 1),
                new OA\Property(property: 'per_page',       type: 'integer', example: 15),
                new OA\Property(property: 'total',          type: 'integer', example: 100),
                new OA\Property(property: 'last_page',      type: 'integer', example: 7),
            ]
        ),
    ]
)]
class BookListResponse {}
