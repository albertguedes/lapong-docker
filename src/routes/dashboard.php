<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController as Dashboard;

Route::get('/dashboard', [Dashboard::class,'dashboard'])->name('dashboard');
