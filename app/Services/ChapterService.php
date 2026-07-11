<?php

namespace App\Services;

use App\Models\Books\Book;
use App\Models\Books\Chapter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;


class ChapterService
{
    public function createChapter(Book $book, array $data): Chapter
    {
        $nextOrder = $book->chapters()->max('order') + 1;

        $chapter = Chapter::create([
            'book_id' => $book->id,
            'title' => $data['title'],
            'content' => $data['content'],
            'order' => $nextOrder,
            'word_count' => str_word_count($data['content']),
        ]);

        return $chapter;
    }


    public function updateChapter(Chapter $chapter, array $data): Chapter
    {
        $chapter->update([
            'title' => $data['title'] ?? $chapter->title,
            'content' => $data['content'] ?? $chapter->content,
            'word_count' => isset($data['content']) ? str_word_count($data['content']) : $chapter->word_count,
        ]);

        return $chapter;
    }

    public function deleteChapter(Chapter $chapter): void
    {
        $chapter->delete();
    }

    public function listBookChapters(Book $book): LengthAwarePaginator
    {
        return $book->chapters()
            ->select(['id', 'title', 'order', 'word_count', 'total_reads', 'is_published', 'published_at'])
            ->paginate(10);
    }

    public function fetchChapter(Chapter $chapter): Chapter
    {
        $chapter->increment('total_reads');

        return $chapter;
    }

}
