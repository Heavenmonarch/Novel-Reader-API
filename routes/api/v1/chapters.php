<?php

use App\Http\Controllers\api\v1\Book\ChapterController;
Use Illuminate\Support\Facades\Route;


Route::controller(ChapterController::class)->prefix('/books')->group(function () {
    Route::get('/{book}/list-all-chapters', 'listAllChapters');
    Route::get('/{book}/fetch-chapter/{chapter}', 'fetchChapter');
    Route::post('/{book}/create-chapter', 'createChapter');
    Route::patch('/{book}/update-chapter/{chapter}', 'updateChapter');
    Route::delete('/{book}/delete-chapter/{chapter}', 'deleteChapter');
})
