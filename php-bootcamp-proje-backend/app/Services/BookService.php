<?php

namespace App\Services;

use App\Models\Book;

class BookService
{

    public function getAll()
    {
        return Book::all();
    }
    public function createBook($data)
    {

        $data = $data->validate([
            'isbn' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'cover_image_path' => 'nullable|string',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
        ]);

        return Book::create($data);
    }
    public function getById($id)
    {
        return Book::find($id);
    }
    public function update($id, $data)
    {
        $data = $data->validate([
            'isbn' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'cover_image_path' => 'nullable|string',
            'author' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
        ]);

        $book = Book::find($id);
        if ($book) {
            $book->update($data);
            return $book;
        }
        return null;
    }

    public function delete($id)
    {
        $book = Book::find($id);
        if ($book) {
            $book->delete();
            return true;
        }
        return false;
    }
}