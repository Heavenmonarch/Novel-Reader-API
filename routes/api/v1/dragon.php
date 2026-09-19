<?php

use App\Http\Controllers\Api\v1\Book\DragonController;
use Illuminate\Support\Facades\Route;

Route::controller(DragonController::class)->group(function () {
    Route::post('/vote',                        'vote');
    Route::delete('/unvote',                    'unvote');
    Route::get('/book/{bookId}/count',          'bookDragonCount');
    Route::get('/book/{bookId}/chapters',       'chapterDragonCounts');
    Route::get('/book/{bookId}/check',          'checkVote');
});
