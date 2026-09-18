<?php

use App\Http\Controllers\Api\v1\Book\LibraryController;
use Illuminate\Support\Facades\Route;

Route::get('/fetch-user-library',              [LibraryController::class, 'fetchUserLibrary']);
Route::post('/add-book-to-library',            [LibraryController::class, 'addBookToLibrary']);
Route::delete('/remove-book/{bookId}',         [LibraryController::class, 'removeBookFromLibrary']);
Route::get('/check-book/{bookId}',             [LibraryController::class, 'checkBookInLibrary']);
