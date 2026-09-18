<?php

use App\Http\Controllers\api\v1\Book\ChapterController;
Use Illuminate\Support\Facades\Route;


Route::controller(ChapterController::class)->group(function () {
    Route::get('list-all-chapters', 'listAllChapters');
    Route::get('/fetch-chapter/{chapter}', 'fetchChapter');
    Route::post('/create-chapter', 'createChapter');
    Route::patch('/update-chapter/{chapter}', 'updateChapter');
    Route::delete('/delete-chapter/{chapter}', 'deleteChapter');
});
