<?php

namespace App\Models;

use App\Models\Books\Library;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'email',
        'password',
        'username',
        'display_name',
        'avatar',
        'bio',
        'role',
        'genre_preference',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'password' => 'hashed'
        ];
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function library(): HasMany
    {
        return $this->hasMany(Library::class);
    }

    public function isAuthor(): bool
    {
        return $this->role === 'author';
    }

    public function isReader(): bool
    {
        return $this->role === 'reader';
    }
}
