<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    protected $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function create(Request $request)
    {
        $book = $this->bookService->createBook($request);
        return response()->json($book, 200);
    }

    public function index()
    {
        $books = $this->bookService->getAll();
        return response()->json($books, 200);
    }

    public function show($id)
    {
        $book = $this->bookService->getById($id);
        if ($book) {
            return response()->json($book, 200);
        }
        return response()->json(['error' => 'Book not found'], 404);
    }

    public function update(Request $request, $id)
    {
        $book = $this->bookService->update($id, $request);
        if ($book) {
            return response()->json($book, 200);
        }
        return response()->json(['error' => 'Book not found'], 404);
    }

    public function delete($id)
    {
        $result = $this->bookService->delete($id);
        if ($result) {
            return response()->json(['message' => 'Book deleted successfully'], 200);
        }
        return response()->json(['error' => 'Book not found'], 404);
    }
}
