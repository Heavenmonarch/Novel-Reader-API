<?php

namespace App\Http\Controllers\api\v1\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\CreateBookRequest;
use App\Http\Requests\Books\UpdateBookRequest;
use App\Models\Books\Book;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function __construct(protected BookService $bookService) {}

    public function getAuthorBooks(Request $request): JsonResponse
    {
        $books = $this->bookService->getAuthorBooks($request->user());
        return response()->json([
            'status' => 'success',
            'data' => $books
        ], 200);
    }

    public function createBook(CreateBookRequest $request): JsonResponse
    {
        $book = $this->bookService->createNewBook($request->user(), $request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    public function getBook (Book $book): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->bookService->getBook($book),
        ]);
    }

    public function updateBook(UpdateBookRequest $request, Book $book): JsonResponse
    {
        abort_if(!$book->isOwnedBy($request->user()), 403, 'You do not own this book.');
        abort_if($book->is_locked, 403, 'Published books can only be edited from the author dashboard.');

        $book = $this->bookService->updateBook($book, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Book updated successfully',
            'data' => $book,
        ], 200);
    }

    public function publishBook (Request $request, Book $book): JsonResponse
    {
        abort_if(!$book->isOwnedBy($request->user()), 403, 'You do not own this book.');
        abort_if(!$book->isDraft(), 422, 'Only draft books can be published');

        $book = $this->bookService->publishBook($book);

        return response()->json([
            'status' => 'success',
            'message' => 'Book published successfully',
            'data' => $book,
        ], 200);
    }

    public function deleteBook (Request $request, Book $book): JsonResponse
    {
        abort_if(!$book->isOwnedBy($request->user()), 403, 'You do not own this book.');

        $this->bookService->deleteBook($book);

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully',
        ], 204);
    }

}
