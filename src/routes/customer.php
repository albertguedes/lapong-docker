<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\AddressesController as CustomerAddresses;
use App\Http\Controllers\Customer\ContactsController as ContactCustomers;
use App\Http\Controllers\Customer\DocumentsController as CustomerDocuments;
use App\Http\Controllers\Customer\ProfileController as CustomerProfile;

// Customer Profile
Route::controller(CustomerProfile::class)->prefix('profile')->name('customer.profile')->group(function () {

    // Show a Profile
    Route::get('/', 'index')->name('');

    // Update a Profile
    Route::get('/edit', 'edit')->name('.edit');
    Route::put('/', 'update')->name('.update');

    // Delete a Profile
    Route::get('/delete', 'delete')->name('.delete');
    Route::delete('/', 'destroy')->name('.destroy');
});

// Customer Address
Route::controller(CustomerAddresses::class)->group(function () {

    // List addresses
    Route::get('profile/addresses', 'index')->name('customer.addresses');

    Route::prefix('profile/address')->name('customer.address')->group(function () {

        // Create a Address
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');

        // Show a Address
        Route::get('/{address}', 'show')->name(''); // NOTE: Put this in here because of the /{address}

        // Update a Address
        Route::get('/{address}/edit', 'edit')->name('.edit');
        Route::put('/{address}', 'update')->name('.update');

        // Delete a Address
        Route::get('/{address}/delete', 'delete')->name('.delete');
        Route::delete('/{address}', 'destroy')->name('.destroy');
    });
});

// Customer Documents
Route::controller(CustomerDocuments::class)->group(function () {

    // List documents
    Route::get('profile/documents', 'index')->name('customer.documents');

    Route::prefix('profile/document')->name('customer.document')->group(function () {

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

// Customer Contacts
Route::controller(ContactCustomers::class)->group(function () {

    // List contacts
    Route::get('profile/contacts', 'index')->name('customer.contacts');

    Route::prefix('profile/contact')->name('customer.contact')->group(function () {

        // Create a Contact
        Route::get('/create', 'create')->name('.create');
        Route::post('/', 'store')->name('.store');

        // Show a Contact
        Route::get('/{contact}', 'show')->name('');

        // Update a Contact
        Route::get('/{contact}/edit', 'edit')->name('.edit');
        Route::put('/{contact}', 'update')->name('.update');

        // Delete a Contact
        Route::get('/{contact}/delete', 'delete')->name('.delete');
        Route::delete('/{contact}', 'destroy')->name('.destroy');
    });
});
