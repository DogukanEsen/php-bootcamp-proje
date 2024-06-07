<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookService
{

    public function getAll()
    {
        return Book::all();
    }
    public function createBook($request)
    {

        $data = $request->validate([
            'isbn' => 'required|string|max:255|unique:books,isbn',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer'
        ]);

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('img', $filename, 'public');
            $data['cover_image_path'] = $path;
        }
        Book::create($data);
        return ['success' => true, 'message' => 'Book successfully created.'];
    }
    public function getById($id)
    {
        return Book::findOrFail($id);
    }
    public function getByCategory($category)
    {
        return Book::where('category', $category)->get();
    }
    public function update($id, $request)
    {
        $data = $request->validate([
            'isbn' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'category' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'author' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
        ]);

        $book = Book::find($id);
        if ($book) {

            if ($request->hasFile('cover_image')) {
                if ($book->cover_image_path) {
                    Storage::disk('public')->delete($book->cover_image_path);
                }

                $file = $request->file('cover_image');
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('img', $filename, 'public');
                $data['cover_image_path'] = $path;
            }
            $book->update($data);
            return ['success' => true, 'book' => $book, 'message' => 'Book successfully updated.'];
        }
        return ['success' => false, 'message' => 'Book not found.'];
    }

    public function search($query)
    {

        $results = Book::where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhere('category', 'like', "%$query%")
            ->get();

        return $results;
    }

    public function delete($id)
    {
        $book = Book::find($id);
        if ($book) {
            if ($book->cover_image_path) {
                Storage::disk('public')->delete($book->cover_image_path);
            }
            $book->delete();
            return ['success' => true, 'message' => 'Book successfully deleted.'];
        }
        return ['success' => false, 'message' => 'Book not found.'];
    }
}