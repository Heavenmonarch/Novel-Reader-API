<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Fantasy',        'icon' => '🐉', 'description' => 'Magic, mythical creatures, and imaginary worlds.'],
            ['name' => 'Romance',        'icon' => '💕', 'description' => 'Love stories and romantic relationships.'],
            ['name' => 'Thriller',       'icon' => '🔪', 'description' => 'Suspense, tension, and high stakes.'],
            ['name' => 'Science Fiction','icon' => '🚀', 'description' => 'Futuristic technology, space, and scientific exploration.'],
            ['name' => 'Horror',         'icon' => '👻', 'description' => 'Fear, dread, and the supernatural.'],
            ['name' => 'Mystery',        'icon' => '🔍', 'description' => 'Puzzles, detective work, and hidden secrets.'],
            ['name' => 'Adventure',      'icon' => '🗺️',  'description' => 'Journeys, exploration, and excitement.'],
            ['name' => 'Historical',     'icon' => '📜', 'description' => 'Stories set in historical periods.'],
            ['name' => 'Sports',         'icon' => '⚽', 'description' => 'Competitive sports and athlete journeys.'],
            ['name' => 'Drama',          'icon' => '🎭', 'description' => 'Emotional narratives and character conflict.'],
            ['name' => 'Comedy',         'icon' => '😂', 'description' => 'Humor, wit, and lighthearted storytelling.'],
            ['name' => 'Action',         'icon' => '💥', 'description' => 'Fast-paced sequences and physical conflict.'],
            ['name' => 'Slice of Life',  'icon' => '🌸', 'description' => 'Everyday experiences and realistic settings.'],
            ['name' => 'Supernatural',   'icon' => '✨', 'description' => 'Paranormal events beyond natural explanation.'],
            ['name' => 'Young Adult',    'icon' => '📚', 'description' => 'Stories targeted at teenage and young adult readers.'],
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insertOrIgnore([
                'name'        => $genre['name'],
                'slug'        => Str::slug($genre['name']),
                'icon'        => $genre['icon'],
                'description' => $genre['description'],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
