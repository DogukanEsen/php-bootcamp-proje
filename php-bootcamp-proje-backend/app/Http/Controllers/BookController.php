<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{

    protected $bookService;
    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        $books = $this->bookService->getAll();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $book = $this->bookService->createBook($request);

        return redirect('/books');
    }

    public function show($id)
    {
        $book = $this->bookService->getById($id);
        return view('books.show', compact('book'));
    }

    public function showCategory($name)
    {

        $books = $this->bookService->getByCategory($name);


        return view('books.category', ['books' => $books, 'category' => $name]);
    }

    public function edit($id)
    {
        $book = $this->bookService->getById($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = $this->bookService->update($id, $request);

        return view('books.show', compact('book'));
    }

    public function destroy($id)
    {
        $book = $this->bookService->delete($id);

        return redirect('/books');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $books = $this->bookService->search($search);
        return view('books.search-results', compact('books'));
    }
}