<?php

namespace App\Swagger\Annotations\Books;

use OpenApi\Attributes as OA;

class BookController
{
    #[OA\Get(
        path: '/books/get-author-books',
        summary: 'Get all books by the authenticated author',
        tags: ['Books'],
        security: [['bearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'List of author books',  content: new OA\JsonContent(ref: '#/components/schemas/BookListResponse')),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function index(): void {}

    #[OA\Post(
        path: '/books/create-book',
        summary: 'Create a new draft book',
        tags: ['Books'],
        security: [['bearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/CreateBookRequest')
        ),
        responses: [
            new OA\Response(response: 201, description: 'Book created successfully', content: new OA\JsonContent(ref: '#/components/schemas/BookResponse')),
            new OA\Response(response: 422, description: 'Validation failed'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function store(): void {}

    #[OA\Get(
        path: '/books/get-book/{book}',
        summary: 'Get a single book',
        tags: ['Books'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'book', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Book details',  content: new OA\JsonContent(ref: '#/components/schemas/BookResponse')),
            new OA\Response(response: 404, description: 'Book not found'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function show(): void {}

    #[OA\Patch(
        path: '/books/update-book/{book}',
        summary: 'Update a draft book synopsis, cover, genre or tags',
        tags: ['Books'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'book', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(ref: '#/components/schemas/UpdateBookRequest')
        ),
        responses: [
            new OA\Response(response: 200, description: 'Book updated successfully', content: new OA\JsonContent(ref: '#/components/schemas/BookResponse')),
            new OA\Response(response: 403, description: 'Forbidden — not owner or book is locked'),
            new OA\Response(response: 422, description: 'Validation failed'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function update(): void {}

    #[OA\Post(
        path: '/books/publish-book/{book}',
        summary: 'Publish a draft book',
        tags: ['Books'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'book', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Book published successfully', content: new OA\JsonContent(ref: '#/components/schemas/BookResponse')),
            new OA\Response(response: 403, description: 'Forbidden — not owner'),
            new OA\Response(response: 422, description: 'No chapters or already published'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function publish(): void {}

    #[OA\Delete(
        path: '/books/delete-book/{book}',
        summary: 'Delete a book',
        tags: ['Books'],
        security: [['bearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'book', in: 'path', required: true, schema: new OA\Schema(type: 'integer'), example: 1),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Book deleted successfully'),
            new OA\Response(response: 403, description: 'Forbidden — not owner'),
            new OA\Response(response: 401, description: 'Unauthenticated'),
        ]
    )]
    public function destroy(): void {}
}
