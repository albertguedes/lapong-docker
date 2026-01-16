<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Company;
use App\Models\Email;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::each(function ($customer) {
            $emails = Email::factory()
                           ->count(self::numberOfEmails())
                           ->make();

            $customer->emails()->saveMany($emails);
        });

        Company::each(function ($company) {
            $emails = Email::factory()
                           ->count(self::numberOfEmails())
                           ->make();

            $company->emails()->saveMany($emails);
        });

    }

    private static function numberOfEmails(): int
    {
        return rand(1, 5);
    }
}
