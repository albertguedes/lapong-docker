<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessagesController as Messages;

Route::controller(Messages::class)->group(function () {

    Route::prefix('/messages')->name('messages')->group(function () {

        // List all received messages
        Route::get('/', 'index')->name('');

        // List sent messages
        Route::get('/sent', 'sent')->name('.sent');

        // List saved messages
        Route::get('/saved', 'saved')->name('.saved');

        // List deleted messages
        Route::get('/trash', 'trash')->name('.trash');
    });

    Route::prefix('/message')->name('message')->group(function () {

        // Create a Message
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');

        // Show a Message
        Route::get('/{message}', 'show')->name('');

        // Update a Message
        Route::get('/{message}/edit', 'edit')->name('.edit');
        Route::put('/{message}', 'update')->name('.update');

        // Delete a Message
        Route::get('/{message}/delete', 'delete')->name('.delete');
        Route::delete('/{message}', 'destroy')->name('.destroy');
    });
});
