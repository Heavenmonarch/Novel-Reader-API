<?php

namespace App\Swagger\Schemas\Responses\Chapter;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ChapterListResponse',
    properties: [
        new OA\Property(property: 'status', type: 'string', example: 'success'),
        new OA\Property(
            property: 'data',
            type: 'object',
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items(
                        properties: [
                            new OA\Property(property: 'id',           type: 'integer', example: 1),
                            new OA\Property(property: 'title',        type: 'string',  example: 'The Beginning'),
                            new OA\Property(property: 'order',        type: 'integer', example: 1),
                            new OA\Property(property: 'word_count',   type: 'integer', example: 1500),
                            new OA\Property(property: 'total_reads',  type: 'integer', example: 0),
                            new OA\Property(property: 'is_published', type: 'boolean', example: false),
                            new OA\Property(property: 'published_at', type: 'string',  example: null),
                        ]
                    )
                ),
                new OA\Property(property: 'current_page', type: 'integer', example: 1),
                new OA\Property(property: 'per_page',     type: 'integer', example: 15),
                new OA\Property(property: 'total',        type: 'integer', example: 10),
                new OA\Property(property: 'last_page',    type: 'integer', example: 1),
            ]
        ),
    ]
)]
class ChapterListResponse {}
