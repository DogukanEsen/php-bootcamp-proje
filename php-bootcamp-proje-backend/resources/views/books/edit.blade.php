@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Edit Book</h1>
    <form action="{{ route('books.update', ['id' => $book->id]) }}" method="POST"enctype="multipart/form-data">>
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $book->title }}" required>
        </div>
        <div class="form-group">
            <label for="author">Author:</label>
            <input type="text" class="form-control" name="author" id="author" value="{{ $book->author }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" name="description" id="description" rows="3">{{ $book->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Kategori</label>
            <select class="form-select" id="category" name="category">
                <option value={{ $book->category }} selected>{{ $book->category }}</option>
                <option value="Cok_satanlar">Çok satanlar</option>
                <option value="Macera">Macera</option>
                <option value="Korku">Korku</option>
                <option value="Ask">Aşk</option>
                <option value="Tarih">Tarih</option>
                <option value="Fantastik">Fantastik</option>
                <option value="Bilim_kurgu">Bilim kurgu</option>
                <option value="Cinayet">Cinayet</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="cover_image" class="form-label">Kapak Resmi</label>
            <input type="file" class="form-control" id="cover_image" name="cover_image"
                accept="image/jpeg,image/png,image/jpg">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" name="price" id="price" value="{{ $book->price }}" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="text" class="form-control" name="quantity" id="quantity" value="{{ $book->quantity }}"
                required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
