<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Company;
use App\Models\Telephone;

class TelephoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::each(function ($customer) {
            $telephones = Telephone::factory()
                                ->count(self::numberOfTelephones())
                                ->make();

            $customer->telephones()->saveMany($telephones);
        });

        Company::each(function ($company) {
            $telephones = Telephone::factory()
                                ->count(self::numberOfTelephones())
                                ->make();

            $company->telephones()->saveMany($telephones);
        });
    }

    private static function numberOfTelephones(): int
    {
        return rand(1, 5);
    }
}
