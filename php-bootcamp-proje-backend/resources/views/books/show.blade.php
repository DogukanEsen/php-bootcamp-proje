@extends('layouts.app')

@section('content')
    <h1 class="mb-4">{{ $book->title }}</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Author: {{ $book->author }}</h5>
            <p class="card-text">Description: {{ $book->description }}</p>
            <p class="card-text">Isbn: {{ $book->isbn }}</p>
            <p class="card-text">Category: {{ $book->category }}</p>
            <p class="card-text">Cover Image Path: {{ $book->cover_image_path }}</p>
            <p class="card-text">Price: ₺{{ $book->price }}</p>
            <p class="card-text">Quantity: {{ $book->quantity }}</p>
            <a href="{{ url('books/' . $book->id . '/edit') }}" class="btn btn-secondary">Edit</a>

            <form action="{{ url('books/' . $book->id) }}" method="POST" class="d-inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>

            <a href="{{ url('/books') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
@endsection
