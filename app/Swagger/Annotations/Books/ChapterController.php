<?php

namespace App\Swagger\Annotations\Books;

use OpenApi\Attributes as OA;

class ChapterController
{
    #[OA\Get(
        path: '/books/chapters/{book}/list-all-chapters',
        summary: 'Get all chapters of a book',
        tags: ['Chapters'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'book', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        responses: [
            new OA\Response(response: 200, description: 'List of chapters', content: new OA\JsonContent(ref: '#/components/schemas/ChapterListResponse')),
            new OA\Response(response: 404, description: 'Book not found'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function index(): void {}

    #[OA\Post(
        path: '/books/chapters/{book}/create-chapter',
        summary: 'Add a new chapter to a book',
        tags: ['Chapters'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'book', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/CreateChapterRequest')
        ),
        responses: [
            new OA\Response(response: 201, description: 'Chapter added successfully',  content: new OA\JsonContent(ref: '#/components/schemas/ChapterResponse')),
            new OA\Response(response: 403, description: 'Forbidden — not book owner'),
            new OA\Response(response: 422, description: 'Validation failed'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function store(): void {}

    #[OA\Get(
        path: '/books/chapters/{book}/fetch-chapter/{chapter}',
        summary: 'Get a single chapter with full content',
        tags: ['Chapters'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'book',    in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
            new OA\Parameter(name: 'chapter', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Chapter details', content: new OA\JsonContent(ref: '#/components/schemas/ChapterResponse')),
            new OA\Response(response: 404, description: 'Chapter not found'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function show(): void {}

    #[OA\Patch(
        path: '/books/chapters/{book}/update-chapter/{chapter}',
        summary: 'Update a chapter title or content',
        tags: ['Chapters'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'book',    in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
            new OA\Parameter(name: 'chapter', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/UpdateChapterRequest')
        ),
        responses: [
            new OA\Response(response: 200, description: 'Chapter updated successfully', content: new OA\JsonContent(ref: '#/components/schemas/ChapterResponse')),
            new OA\Response(response: 403, description: 'Forbidden — not book owner'),
            new OA\Response(response: 422, description: 'Validation failed'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function update(): void {}

    #[OA\Delete(
        path: '/books/chapters/{book}/delete-chapter/{chapter}',
        summary: 'Delete a chapter',
        tags: ['Chapters'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'book',    in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
            new OA\Parameter(name: 'chapter', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Chapter deleted successfully'),
            new OA\Response(response: 403, description: 'Forbidden — not book owner'),
            new OA\Response(response: 404, description: 'Chapter not found'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function destroy(): void {}
}
