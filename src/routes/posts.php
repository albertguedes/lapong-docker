<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController as Posts;

// Posts
Route::controller(Posts::class)->group(function () {

    // List posts
    Route::get('/posts', 'index')->name('posts');

    Route::prefix('post')->name('post')->group(function () {

        // Create a Post
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');

        // Show a Post
        Route::get('/{post}', 'show')->name('');

        // Update a Post
        Route::get('/{post}/edit', 'edit')->name('.edit');
        Route::put('/{post}', 'update')->name('.update');

        // Delete a Post
        Route::get('/{post}/delete', 'delete')->name('.delete');
        Route::delete('/{post}', 'destroy')->name('.destroy');
    });
});
