@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Books</h1>
    <div class="row">
        @foreach ($books as $book)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <p class="card-text">Author: {{ $book->author }}</p>
                        <p class="card-text">Price: ${{ $book->price }}</p>
                        @if ($book->cover_image_path)
                            <img src="{{ Storage::url($book->cover_image_path) }}" alt="{{ $book->title }}" width="100">
                        @endif
                        <a href="{{ url('books/' . $book->id) }}" class="btn btn-primary">View Details</a>
                        <a href="{{ url('books/' . $book->id . '/edit') }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ url('books/' . $book->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
