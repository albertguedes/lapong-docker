<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController as News;

// News
Route::controller(News::class)->group(function () {

    Route::prefix('/news')->name('news')->group(function () {
        // List news
        Route::get('/', 'index')->name('');
        // Search news
        Route::get('/search', 'search')->name('.search');
    });

    // Show a news
    Route::get('/new/{new}', 'show')->name('new');
});
