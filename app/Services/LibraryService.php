<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Library;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class LibraryService
{
    public function addToLibrary(User $user, int $bookId): Library
    {
        $book = Book::findOrFail($bookId);

        abort_if(!$book->isPublished(), 422, 'You can only add published books to your library.');
        abort_if($book->isOwnedBy($user), 422, 'You cannot add your own book to your library.');

        $entry = Library::firstOrCreate([
            'user_id' => $user->id,
            'book_id' => $bookId,
        ]);

        abort_if(!$entry->wasRecentlyCreated, 422, 'This book is already in your library.');

        // increment the book's collection count
        $book->increment('total_collections');

        return $entry->load('book.genre');
    }

    public function removeFromLibrary(User $user, int $bookId): void
    {
        $entry = Library::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->firstOrFail();

        $entry->delete();


        Book::where('id', $bookId)->decrement('total_collections');
    }

    public function getLibrary(User $user): LengthAwarePaginator
    {
        return Library::where('user_id', $user->id)
            ->with(['book' => function ($query) {
                $query->select(['id', 'title', 'slug', 'cover_image', 'status', 'total_reads', 'total_dragons'])
                    ->with('genre:id,name,slug');
            }])
            ->latest()
            ->paginate(15);
    }

    public function isInLibrary(User $user, int $bookId): bool
    {
        return Library::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->exists();
    }
}
