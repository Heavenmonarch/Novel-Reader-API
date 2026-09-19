<?php

namespace App\Http\Controllers\Api\v1\Book;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dragon\VoteDragonRequest;
use App\Services\DragonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DragonController extends Controller
{
    public function __construct(protected DragonService $dragonService) {}

    public function vote(VoteDragonRequest $request): JsonResponse
    {
        $dragon = $this->dragonService->vote($request->user(), $request->validated());

        return response()->json([
            'status'  => 'success',
            'message' => 'Dragon voted successfully.',
            'data'    => $dragon,
        ], 201);
    }

    public function unvote(Request $request): JsonResponse
    {
        $this->dragonService->unvote(
            $request->user(),
            $request->book_id,
            $request->chapter_id ?? null
        );

        return response()->json([
            'status'  => 'success',
            'message' => 'Dragon vote removed.',
        ]);
    }

    public function bookDragonCount(int $bookId): JsonResponse
    {
        $count = $this->dragonService->getBookDragonCount($bookId);

        return response()->json([
            'status' => 'success',
            'data'   => ['total_dragons' => $count],
        ]);
    }

    public function chapterDragonCounts(int $bookId): JsonResponse
    {
        $counts = $this->dragonService->getChapterDragonCounts($bookId);

        return response()->json([
            'status' => 'success',
            'data'   => $counts,
        ]);
    }

    public function checkVote(Request $request, int $bookId): JsonResponse
    {
        $hasVoted = $this->dragonService->hasVoted(
            $request->user(),
            $bookId,
            $request->chapter_id ?? null
        );

        return response()->json([
            'status' => 'success',
            'data'   => ['has_voted' => $hasVoted],
        ]);
    }
}
