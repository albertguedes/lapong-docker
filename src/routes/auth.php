<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController as Auth;

// Redirect to login from home by default.
Route::redirect('/', '/auth/login',301)->name('home');

Route::controller(Auth::class)->prefix('auth')->name('auth')->group(function () {

    // Login
    Route::get('/login', 'login')->name('.login');
    Route::post('/authenticate', 'authenticate')->name('.authenticate');

    // Logout
    Route::post('/logout', 'logout')->middleware('auth')->name('.logout');

    // Register
    Route::get('/register', 'register')->name('.register');
    Route::post('/store', 'store')->name('.store');

    // Recover
    Route::get('/recover', 'recover')->name('.recover');
    Route::post('/request', 'recover_request')->name('.recover_request');

    // Success and fail
    Route::get('/success', 'success')->name('.success');
    Route::get('/fail', 'fail')->name('.fail');
});
