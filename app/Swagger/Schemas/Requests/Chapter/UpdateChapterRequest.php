<?php

namespace App\Swagger\Schemas\Requests\Chapter;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UpdateChapterRequest',
    properties: [
        new OA\Property(property: 'title',   type: 'string', example: 'The Beginning Revised'),
        new OA\Property(property: 'content', type: 'string', example: 'It was a bright and stormy night when the last dragon spread its wings...'),
    ]
)]
class UpdateChapterRequest {}
