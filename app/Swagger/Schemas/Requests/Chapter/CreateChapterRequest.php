<?php

namespace App\Swagger\Schemas\Requests\Chapter;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'CreateChapterRequest',
    required: ['title', 'content'],
    properties: [
        new OA\Property(property: 'title',   type: 'string', example: 'The Beginning'),
        new OA\Property(property: 'content', type: 'string', example: 'It was a dark and stormy night when the last dragon spread its wings...'),
    ]
)]
class CreateChapterRequest {}
