<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController as Pages;

Route::controller(Pages::class)->name('pages')->group(function () {
    Route::get('/privacy', 'privacy')->name('.privacy');
    Route::get('/terms', 'terms')->name('.terms');
    Route::get('/about', 'about')->name('.about');
    Route::get('/help', 'help')->name('.help');
});
