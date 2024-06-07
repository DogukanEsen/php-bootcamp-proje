<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/books');
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
Route::get('/search', [BookController::class, 'search'])->name('books.search');


Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [userController::class, 'register']);
Route::get('/login', [userController::class, 'showLoginForm'])->name('login');
Route::post('/login', [userController::class, 'login']);
Route::post('/logout', [userController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/account/settings', [UserController::class, 'showAccountSettings'])->name('account.settings');
    Route::put('/account/settings', [UserController::class, 'update'])->name('account.update');
});

