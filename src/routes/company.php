<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\AddressesController as CompanyAddresses;
use App\Http\Controllers\Company\ClientsController as CompanyClients;
use App\Http\Controllers\Company\DocumentsController as CompanyDocuments;
use App\Http\Controllers\Company\EmployersController as CompanyEmployers;
use App\Http\Controllers\Company\InfoController as CompanyInfo;

// Company Info
Route::controller(CompanyInfo::class)->group(function () {
    Route::prefix('company')->name('company')->group(function () {

        // Show the Company Info
        Route::get('/', 'index')->name('');

        // Update the Company Info
        Route::get('/edit', 'edit')->name('.edit');
        Route::put('/', 'update')->name('.update');

        // Delete the Company
        Route::get('/delete', 'delete')->name('.delete');
        Route::delete('/', 'destroy')->name('.destroy');
    });
});

// Company Documents
Route::controller(CompanyDocuments::class)->group(function () {

    // List documents
    Route::get('/company/documents', 'index')->name('company.documents');

    Route::prefix('company/document')->name('company.document')->group(function () {

        // Create a Document
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');

        // Show a Document
        Route::get('/{document}', 'show')->name('');

        // Update a Document
        Route::get('/{document}/edit', 'edit')->name('.edit');
        Route::put('/{document}', 'update')->name('.update');

        // Delete a Document
        Route::get('/{document}/delete', 'delete')->name('.delete');
        Route::delete('/{document}', 'destroy')->name('.destroy');
    });
});

// Company Addresses
Route::controller(CompanyAddresses::class)->group(function () {

    // List addresses
    Route::get('/company/addresses','index')->name('company.addresses');

    Route::prefix('/company/address')->name('company.address')->group(function () {

        // Show an address
        Route::get('/','show')->name('');

        // Create an address
        Route::get('/create','create')->name('.create');
        Route::post('/store', 'store')->name('.store');

        // Update an address
        Route::get('/{address}/edit','edit')->name('.edit');
        Route::put('/{address}', 'update')->name('.update');

        // Delete an address
        Route::get('/{address}/delete', 'delete')->name('.delete');
        Route::delete('/{address}', 'destroy')->name('.destroy');
    });
});

// Company Employers
Route::controller(CompanyEmployers::class)->group(function () {

    Route::prefix('/company/employers')->name('company.employers')->group(function () {
        // List employers
        Route::get('/', 'index')->name('');

        // Search employers
        Route::get('/search', 'search')->name('.search');
    });

    // Employer actions
    Route::prefix('/company/employer')->name('company.employer')->group(function () {

        // Add an Employer
        Route::get('/create', 'create')->name('.create');
        Route::post('/{employer}', 'store')->name('.store');

        // Remove an Employer
        Route::delete('/{employer}', 'destroy')->name('.destroy');
    });
});

// Company Clients
Route::controller(CompanyClients::class)->group(function () {

    // List clients
    Route::get('/company/clients','index')->name('company.clients');

    Route::prefix('/company/clients')->name('company.clients')->group(function () {
        // Add an Client
        Route::get('/create', 'create')->name('.create');
        Route::post('/{client}', 'store')->name('.store');

        // Remove an Client
        Route::delete('/{client}', 'destroy')->name('.destroy');
    });
});
