<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'book_id', 'title', 'content', 'order',
        'word_count', 'total_reads', 'is_published',
        'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime'
    ]

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function isPublished(): bool
    {
        return $this->is_published === true;
    }
}
