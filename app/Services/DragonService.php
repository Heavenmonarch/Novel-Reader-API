<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Dragon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DragonService
{
    public function vote(User $user, array $data): Dragon
    {
        $book = Book::findOrFail($data['book_id']);

        abort_if(!$book->isPublished(), 422, 'You can only vote on published books.');
        abort_if($book->isOwnedBy($user), 422, 'You cannot vote on your own book.');

        $chapterId = $data['chapter_id'] ?? null;

        $existing = Dragon::where('user_id', $user->id)
            ->where('book_id', $data['book_id'])
            ->where('chapter_id', $chapterId)
            ->first();

        abort_if($existing, 422, 'You have already voted on this.');

        return DB::transaction(function () use ($user, $data, $book, $chapterId) {
            $dragon = Dragon::create([
                'user_id'    => $user->id,
                'book_id'    => $data['book_id'],
                'chapter_id' => $chapterId,
            ]);

            $book->increment('total_dragons');

            if ($chapterId) {
                Chapter::where('id', $chapterId)->increment('total_reads');
            }

            return $dragon;
        });
    }

    public function unvote(User $user, int $bookId, ?int $chapterId = null): void
    {
        $dragon = Dragon::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->where('chapter_id', $chapterId)
            ->firstOrFail();

        DB::transaction(function () use ($dragon, $bookId, $chapterId) {
            $dragon->delete();

            Book::where('id', $bookId)->decrement('total_dragons');

            if ($chapterId) {
                Chapter::where('id', $chapterId)->decrement('total_reads');
            }
        });
    }


    public function getBookDragonCount(int $bookId): int
    {
        return Dragon::where('book_id', $bookId)
            ->whereNull('chapter_id')
            ->count();
    }


    public function getChapterDragonCounts(int $bookId): array
    {
        return Dragon::where('book_id', $bookId)
            ->whereNotNull('chapter_id')
            ->select('chapter_id', DB::raw('count(*) as total'))
            ->groupBy('chapter_id')
            ->get()
            ->toArray();
    }


    public function hasVoted(User $user, int $bookId, ?int $chapterId = null): bool
    {
        return Dragon::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->where('chapter_id', $chapterId)
            ->exists();
    }
}
