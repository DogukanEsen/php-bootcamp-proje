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
            @auth
                @if (!Auth::user()->is_admin)
                    <form action="{{ route('cart.add', ['bookId' => $book->id]) }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" value="1"
                                min="1">
                        </div>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                @elseif (Auth::user()->is_admin)
                    <a href="{{ route('books.edit', ['id' => $book->id]) }}" class="btn btn-secondary">Edit</a>

                    <form action="{{ route('books.destroy', ['id' => $book->id]) }}" method="POST" class="d-inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                @endif
            @endauth
            <a href="{{ route('books.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
@endsection
