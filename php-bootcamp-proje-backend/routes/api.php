<?php

use App\Http\Controllers\BookController;



Route::post('books', [BookController::class, 'create']);
Route::get('books', [BookController::class, 'index']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::put('books/{id}', [BookController::class, 'update']);
Route::delete('books/{id}', [BookController::class, 'delete']);

