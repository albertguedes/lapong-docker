<?php declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Medical\CasesController as MedicalCases;
use App\Http\Controllers\Medical\ConsultsController as MedicalConsults;
use App\Http\Controllers\Medical\ExamsController as MedicalExams;
use App\Http\Controllers\Medical\RecordsController as MedicalCaseRecords;
use App\Http\Controllers\Medical\ProfessionalsController as MedicalProfessionals;

Route::prefix('medical')->name('medical')->group(function () {

    // Handle Cases
    Route::controller(MedicalCases::class)->group(function () {

        // List cases
        Route::get('/cases', 'index')->name('.cases');

        Route::prefix('/case')->name('.case')->group(function () {

            // Create a Case
            Route::get('/create', 'create')->name('.create');
            Route::post('/', 'store')->name('.store');

            // Show a Case
            // NOTE: Put this in here, this route causes conflitc because of the /{medicalCase}
            Route::get('/{medicalCase}', 'show')->name('');

            // Update a Case
            Route::get('/{medicalCase}/edit', 'edit')->name('.edit');
            Route::put('/{medicalCase}', 'update')->name('.update');

            // Delete a Case
            Route::get('/{medicalCase}/delete', 'delete')->name('.delete');
            Route::delete('/{medicalCase}', 'destroy')->name('.destroy');

            // Handle Case Records
            Route::prefix('/{medicalCase}')
                ->controller(MedicalCaseRecords::class)
                ->group(function () {

                    // List records
                    Route::get('/records', 'index')->name('.records');

                    Route::prefix('/record')->name('.record')->group(function () {

                        // Create a new Record
                        Route::get('/create', 'create')->name('.create');
                        Route::post('/', 'store')->name('.store');

                        // Show a Record
                        Route::get('/{medicalCaseRecord}', 'show')->name(''); // NOTE: Put this in here

                        // Update a Record
                        Route::get('/{medicalCaseRecord}/edit', 'edit')->name('.edit');
                        Route::put('/{medicalCaseRecord}', 'update')->name('.update');

                        // Delete a Record
                        Route::get('/{medicalCaseRecord}/delete', 'delete')->name('.delete');
                        Route::delete('/{medicalCaseRecord}', 'destroy')->name('.destroy');
                    });
            });
        });
    });

    // Professionals
    Route::controller(MedicalProfessionals::class)->group(function () {
        Route::prefix('professional')->name('.professional')->group(function () {
            Route::get('/', 'index')->name('');
            Route::get('/search', 'search')->name('.search');
            Route::get('/{professional}', 'show')->name('.show');
        });
    });

    // Consults
    Route::controller(MedicalConsults::class)->group(function () {
        Route::prefix('consult')->name('.consult')->group(function () {
            Route::get('/', 'index')->name('');
            Route::post('/', 'store')->name('.store');
        });
    });

    // Exams
    Route::controller(MedicalExams::class)->group(function () {
        Route::prefix('exam')->name('.exam')->group(function () {
            Route::get('/', 'index')->name('');
            Route::post('/', 'store')->name('.store');
        });
    });

});