<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
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

    public function isAuthor(): bool
    {
        return $this->role === 'author';
    }

    public function isReeader(): bool
    {
        return $this->role === 'reader';
    }
}
