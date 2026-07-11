<?php

namespace App\Http\Controllers\api\v1\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chapter\CreateChapterRequest;
use App\Http\Requests\Chapter\UpdateChapterRequest;
use App\Models\Books\Book;
use App\Models\Books\Chapter;
use App\Services\ChapterService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function __construct(protected ChapterService $chapterService){}

    public function listAllChapters(Book $book): JsonResponse
    {
        $chapters = $this->chapterService->listBookChapters($book);

        return response()->json([
            'status' => 'success',
            'data' => $chapters
        ], 200);
    }

    public function createChapter(CreateChapterRequest $request, Book $book): JsonResponse
    {
        abort_if(!$book->isOwnedBy($request->user()), 403, 'You do not own this book');
        $chapter = $this->chapterService->createChapter($book, $request->validated());
        return response()->json([
            'status' => 'success',
            'message' => 'Chapter created successfully',
            'data' => $chapter
        ], 201);
    }

    public function fetchChapter(Book $book, Chapter $chapter): JsonResponse
    {
        abort_if($chapter->book_id !== $book->id, 404, 'Chapter not found for this book.');
        $chapter = $this->chapterService->fetchChapter($chapter);

        return response()->json([
            'status' => 'success',
            'data' => $chapter,
        ], 200);
    }

    public function updateChapter(UpdateChapterRequest $request, Book $book, Chapter $chapter): JsonResponse
    {
        abort_if(!$book->isOwnedBy($request->user()), 403, 'You do not own this book.');
        abort_if($chapter->book_id !== $book->id, 404, 'Chapter not found for this book.');

        $chapter = $this->chapterService->updateChapter($chapter, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Chapter updated successfully',
            'data' => $chapter
        ], 200);
    }

    public function deleteChapter(Book $book, Chapter $chapter): JsonResponse
    {
        abort_if(!$book->isOwnedBy($request->user()), 403, 'You do not own this book.');
        abort_if($chapter->book_id !== $book->id, 404, 'Chapter not found for this book.');

        $this->chapterService->deleteChapter($chapter);
        return response()->json([
            'status' => 'success',
            'message' => 'Chapter deleted successfully',
        ], 204);
    }

}
