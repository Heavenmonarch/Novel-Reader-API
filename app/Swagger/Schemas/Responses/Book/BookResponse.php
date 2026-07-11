<?php

namespace App\Swagger\Schemas\Responses\Book;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'BookResponse',
    properties: [
        new OA\Property(property: 'status', type: 'string', example: 'success'),
        new OA\Property(
            property: 'data',
            type: 'object',
            properties: [
                new OA\Property(property: 'id',                 type: 'integer', example: 1),
                new OA\Property(property: 'title',              type: 'string',  example: 'The Last Dragon'),
                new OA\Property(property: 'slug',               type: 'string',  example: 'the-last-dragon'),
                new OA\Property(property: 'synopsis',           type: 'string',  example: 'A story about the last dragon...'),
                new OA\Property(property: 'cover_image',        type: 'string',  example: 'https://cloudinary.com/cover.jpg'),
                new OA\Property(property: 'status',             type: 'string',  example: 'draft'),
                new OA\Property(property: 'content_rating',     type: 'string',  example: 'teen'),
                new OA\Property(property: 'total_reads',        type: 'integer', example: 0),
                new OA\Property(property: 'total_collections',  type: 'integer', example: 0),
                new OA\Property(property: 'total_dragons',      type: 'integer', example: 0),
                new OA\Property(property: 'is_locked',          type: 'boolean', example: false),
                new OA\Property(property: 'published_at',       type: 'string',  example: null),
                new OA\Property(
                    property: 'genre',
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'id',   type: 'integer', example: 1),
                        new OA\Property(property: 'name', type: 'string',  example: 'Fantasy'),
                        new OA\Property(property: 'slug', type: 'string',  example: 'fantasy'),
                    ]
                ),
                new OA\Property(
                    property: 'tags',
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'id',   type: 'integer', example: 1),
                            new OA\Property(property: 'name', type: 'string',  example: 'slow burn'),
                            new OA\Property(property: 'slug', type: 'string',  example: 'slow-burn'),
                        ]
                    )
                ),
            ]
        ),
    ]
)]
class BookResponse {}
