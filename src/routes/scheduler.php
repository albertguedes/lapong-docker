<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Scheduler\CalendarController as Calendar;
use App\Http\Controllers\Scheduler\ContactsController as Contacts;
use App\Http\Controllers\Scheduler\EventsController as Events;

// Scheduler
Route::prefix('scheduler')
     ->name('scheduler')
     ->group(function () {

        // Redirect Scheduler to Calendar
        Route::redirect('/', '/scheduler/calendar');

        // Calendar
        Route::get('/calendar', [Calendar::class,'index'])->name('.calendar');

        // Contacts
        Route::controller(Contacts::class)
             ->group(function () {

                // List Contacts
                Route::get('/contacts', 'index')->name('.contacts');

                Route::prefix('/contact')
                     ->name('.contact')
                     ->group(function () {

                        // Add an Contact
                        Route::post('/{customer}', 'store')->name('.store');

                        // Remove an Contact
                        Route::delete('/{customer}','destroy')->name('.destroy');
                });
        });

        // Events
        Route::controller(Events::class)
             ->group(function () {

                // List Events
                Route::get('/events', 'index')->name('.events');

                Route::prefix('/event')
                     ->name('.event')
                     ->group(function () {

                        // Create an Event
                        Route::get('/create', 'create')->name('.create');
                        Route::post('/', 'store')->name('.store');

                        // Show an event
                        Route::get('/{event}', 'show')->name('');

                        // Edit an Event
                        Route::get('/{event}/edit', 'edit')->name('.edit');
                        Route::put('/{event}', 'update')->name('.update');

                        // Delete an Event
                        Route::delete('/{event}','destroy')->name('.destroy');
                });
        });
});
