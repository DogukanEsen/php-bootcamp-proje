<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BookController;

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/users/{id}/change-password', [UserController::class, 'changePassword']);
Route::post('/users/{id}/upload-profile-photo', [UserController::class, 'uploadProfilePhotoPath']);

Route::post('books', [BookController::class, 'create']);
Route::get('books', [BookController::class, 'index']);
Route::get('books/{id}', [BookController::class, 'show']);
Route::put('books/{id}', [BookController::class, 'update']);
Route::delete('books/{id}', [BookController::class, 'delete']);

Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::post('/cart/{id}/checkout', [CartController::class, 'checkout']);
