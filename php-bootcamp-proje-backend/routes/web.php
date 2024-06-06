<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\BookController;

Route::get('books', [BookController::class, 'index']);
Route::get('books/create', [BookController::class, 'create']);
Route::post('books', [BookController::class, 'store']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::get('books/{id}/edit', [BookController::class, 'edit']);
Route::put('books/{id}', [BookController::class, 'update']);
Route::delete('books/{id}', [BookController::class, 'destroy']);
Route::get('/kategori/{name}', [BookController::class, 'showCategory'])->name('category.show');
