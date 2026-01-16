<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationsController as Notifications;

Route::controller(Notifications::class)->group(function () {

    // List notifications
    Route::get('/notifications', [Notifications::class,'index'])->name('notifications');

    Route::prefix('notification')->name('notification')->group(function () {

        // Update a notification
        Route::get('/{notification}', 'update')->name('.update');

        // Delete a notification
        Route::delete('/{notification}', 'destroy')->name('.destroy');
    });
});
