<?php

namespace App\Services;

use App\Models\Books\Book;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class BookService
{
    public function createNewBook(User $user, array $data): Book
    {
        return DB::transaction(function () use ($user, $data){
            $book = Book::create([
                'user_id' => $user->id,
                'genre_id' => $data['genre_id'],
                'title' => $data['title'],
                'slug' => $this->generateUniqueSlug($data['title']),
                'synopsis' => $data['synopsis'],
                'cover_image' => $data['cover_image'] ?? null,
                'content_rating' => $data['content_rating'] ?? 'everyone',
                'status' => 'draft',

            ]);

            if (!empty($data['tags'])) {
                $book->tags()->sync($data['tags']);
            }

            return $book->load(['genre', 'tags']);
        });
    }

    public function updateBook(Book $book, array $data): Book
    {
        return DB::transaction(function () use ($book, $data){
            $book->update(array_filter([
                'synopsis' => $data['synopsis'] ?? null,
                'genre_id' => $data['genre_id'] ?? null,
                'cover_image' => $data['cover_image'] ?? null,
                'content_rating' => $data['content_rating'] ?? null,
            ]));

            if (isset($data['tags'])) {
                $book->tags()->sync($data['tags']);
            }

            return $book->load(['genre', 'tags']);
        });
    }


    public function publishBook(Boook $book): Book
    {
        abort_if($book->chapters()->count() === 0, 422,'A book must have at least one chapter before publishing');
        abort_if($book->isPublished(), 422, 'This book is already published');

        $book->update([
            'status' => 'published',
            'is_locked' => true,
            'published_at' => now(),
        ]);

        return $book;

    }

    public function deleteBook(Book $book): void
    {
        $book->delete();
    }

    public function getAuthorBooks(User $user): LengthAwarePaginator
    {
        return Book::where('user_id', $user->id)
            ->with(['genre', 'tags'])
            ->latest()
            ->paginate(10);
    }

    public function getBook(Book $book): Book
    {
        return $book->load(['genre', 'tags', 'author', 'chapters']);
    }


    public function generateUniqueSlug(string $title): string
    {
        $slug = Str::slug($title);
        $count = Book::where('slug', 'like', "{$slug}%")->count();
        return $count > 0 ? "{$slug}-{$count}" : $slug;
    }

}
