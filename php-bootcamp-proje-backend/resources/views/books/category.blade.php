@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $category }} Kategorisindeki Kitaplar</h1>
        @if ($books->isEmpty())
            <p>Bu kategoride henüz kitap yok.</p>
        @else
            <div class="row">
                @foreach ($books as $book)
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ $book->title }}</h5>
                                <p class="card-text">{{ $book->description }}</p>
                                <a href="{{ url('books/' . $book->id) }}" class="btn btn-primary">Detaylar</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
