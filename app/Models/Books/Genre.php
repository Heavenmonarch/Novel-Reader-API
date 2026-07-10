<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Books\Book;

class Genre extends Model
{
    protected $fillable = ['name', 'slug', 'icon', 'description'];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);

    }


}
