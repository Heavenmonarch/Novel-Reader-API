<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'body',
        'is_flagged',
    ];

    protected function casts(): array
    {
        return [
            'is_flagged' => 'boolean',
            'rating'     => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
