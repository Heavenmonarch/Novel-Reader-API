<?php
use App\Http\Controllers\api\v1\Book;
use App\Http\Controllers\api\v1\Book\BookController;
use Illuminate\Support\Facades\Route;


Route::controller(BookController::class)->group(function () {
    Route::get('/get-author-books', 'getAuthorBooks');
    Route::post('/create-book', 'createBook');
    Route::get('/get-book/{book}', 'getBook');
    Route::patch('/update-book/{book}', 'updateBook');
    Route::delete('/delete-book/{book}', 'deleteBook');
    Route::post('/publish-book/{book}', 'publishBook');
});
