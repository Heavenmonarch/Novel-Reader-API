<?php

namespace App\Http\Controllers\Api\v1\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Library\AddToLibraryRequest;
use App\Services\LibraryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function __construct(protected LibraryService $libraryService) {}

    public function fetchUserLibrary(Request $request): JsonResponse
    {
        $library = $this->libraryService->getLibrary($request->user());

        return response()->json([
            'status' => 'success',
            'data'   => $library,
        ]);
    }

    public function addBookToLibrary(AddToLibraryRequest $request): JsonResponse
    {
        $entry = $this->libraryService->addToLibrary(
            $request->user(),
            $request->book_id
        );

        return response()->json([
            'status'  => 'success',
            'message' => 'Book added to your library.',
            'data'    => $entry,
        ], 201);
    }

    public function removeBookFromLibrary(Request $request, int $bookId): JsonResponse
    {
        $this->libraryService->removeFromLibrary($request->user(), $bookId);

        return response()->json([
            'status'  => 'success',
            'message' => 'Book removed from your library.',
        ]);
    }

    public function checkBookInLibrary(Request $request, int $bookId): JsonResponse
    {
        $inLibrary = $this->libraryService->isInLibrary($request->user(), $bookId);

        return response()->json([
            'status' => 'success',
            'data'   => ['in_library' => $inLibrary],
        ]);
    }
}
