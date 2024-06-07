@extends('layouts.app')

@section('content')
    @if (isset($category))
        <h1>{{ $category }} Kategorisindeki Kitaplar</h1>
    @elseif(isset($searchResults))
        <h1>{{ $searchResults }} Arama Sonuçları</h1>
    @else
        <h1 class="mb-4">Books</h1>
    @endif
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
                        <a href="{{ route('books.show', ['id' => $book->id]) }}" class="btn btn-primary">View Details</a>
                        @auth
                            @if (Auth::user()->is_admin)
                                <a href="{{ route('books.edit', ['id' => $book->id]) }}" class="btn btn-secondary">Edit</a>
                                <form action="{{ route('books.destroy', ['id' => $book->id]) }}" method="POST"
                                    class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
