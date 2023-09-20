<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function add(string $title, string $author, int $pages, string $description = null): Book
    {
        return Book::create([
            'title' => $title,
            'author' => $author,
            'pages' => $pages,
            'description' => $description,
        ]);
    }

    public function edit(Book $book, string $title, string $author, int $pages, string $description = null): Book
    {
        $book->update([
            'title' => $title,
            'author' => $author,
            'pages' => $pages,
            'description' => $description,
        ]);

        return $book;
    }

    public function delete(Book $book): ?bool
    {
        return $book->delete();
    }
}
