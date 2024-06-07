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
        $result = $this->bookService->createBook($request);

        if ($result['success']) {
            return redirect()->route('books.index')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function show($id)
    {
        $book = $this->bookService->getById($id);
        return view('books.show', compact('book'));
    }

    public function showCategory($name)
    {

        $books = $this->bookService->getByCategory($name);


        return view('books.index', ['books' => $books, 'category' => $name]);
    }

    public function edit($id)
    {
        $book = $this->bookService->getById($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $result = $this->bookService->update($id, $request);

        if ($result['success']) {
            return redirect()->route('books.show', $result["book"])->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function destroy($id)
    {
        $result = $this->bookService->delete($id);
        if ($result['success']) {
            return redirect()->route('books.index')->with('success', $result['message']);
        } else {
            return redirect()->back()->with('error', $result['message']);
        }
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $books = $this->bookService->search($search);
        return view('books.index', ['books' => $books, 'searchResults' => $search]);
    }
}