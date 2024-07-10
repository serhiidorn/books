<?php

namespace App\Actions;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class CreateBook
{
    public function handle(array $data)
    {
        return Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'cover' => Storage::put('covers', $data['cover']),
            'published_at' => $data['published_at'],
        ]);
    }
}
