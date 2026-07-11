<?php

namespace App\Http\Controllers\api\v1\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Books\CreateBookRequest;
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
}
