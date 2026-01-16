<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController as Contact;

Route::controller(Contact::class)->group(function () {

    // Create a message to contact the Torna Fácil
    Route::get('/contact', 'index')->name('contact');
    Route::post('/contact', 'send')->name('contact.send');
});
