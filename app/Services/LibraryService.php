<?php

namespace App\Services;


use App\Models\Books\Book;
use App\Models\Books\Library;
use App\Models\User;

class LibraryService
{
    public function addToLibrary(User $user,$bookId): Library
    {
        $book = Book::findOrFail($bookId);

        abort_if(!$book->isPublished(),422, 'You can only add published books to your library');
//        abort_if($book->isOwnedBy($user),422, 'You can only add books to your library');

        $entry = Library::firstOrCreate([
            'user_id' => $user->id,
            'book_id' => $bookId,
        ]);
    }

}

