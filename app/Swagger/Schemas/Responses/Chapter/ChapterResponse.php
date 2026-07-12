<?php

namespace App\Swagger\Schemas\Responses\Chapter;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ChapterResponse',
    properties: [
        new OA\Property(property: 'status', type: 'string', example: 'success'),
        new OA\Property(
            property: 'data',
            type: 'object',
            properties: [
                new OA\Property(property: 'id',           type: 'integer', example: 1),
                new OA\Property(property: 'book_id',      type: 'integer', example: 1),
                new OA\Property(property: 'title',        type: 'string',  example: 'The Beginning'),
                new OA\Property(property: 'content',      type: 'string',  example: 'It was a dark and stormy night...'),
                new OA\Property(property: 'order',        type: 'integer', example: 1),
                new OA\Property(property: 'word_count',   type: 'integer', example: 1500),
                new OA\Property(property: 'total_reads',  type: 'integer', example: 0),
                new OA\Property(property: 'is_published', type: 'boolean', example: false),
                new OA\Property(property: 'published_at', type: 'string',  example: null),
                new OA\Property(property: 'created_at',   type: 'string',  example: '2026-07-11T20:11:40.000000Z'),
                new OA\Property(property: 'updated_at',   type: 'string',  example: '2026-07-11T20:11:40.000000Z'),
            ]
        ),
    ]
)]
class ChapterResponse {}
