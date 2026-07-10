<?php

namespace App\Models\Books;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'genre_id', 'title',
        'slug', 'synopsis', 'cover_image',
        'status', 'content_rating', 'total_reads',
        'total_collections', 'total_dragons',
        'is_locked', 'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'is_locked' => 'boolean',
    ];


    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)->orderBy('order');
    }



    public function isPublished(): bool
    {
        return $this->status === 'published';
    }

    public function isDraft(): bool
    {
        return $this->status === 'draft';
    }

    public function isOwnedBy(User $user): bool
    {
        return $this->user_id === $user->id;
    }

}
