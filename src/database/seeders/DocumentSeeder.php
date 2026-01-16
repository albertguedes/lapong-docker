<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;
use App\Models\Customer;
use App\Models\Company;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::each(function ($customer) {
            $documents = Document::factory()
                                ->count(self::numberOfDocuments())
                                ->make();

            $customer->documents()->saveMany($documents);
        });

        Company::each(function ($company) {
            $documents = Document::factory()
                                ->count(self::numberOfDocuments())
                                ->make();

            $company->documents()->saveMany($documents);
        });
    }

    private static function numberOfDocuments(): int
    {
        return rand(1, 5);
    }
}
