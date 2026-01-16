<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Company;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::each(function ($customer) {
            $addresses = Address::factory()
                                ->count(self::numberOfAddresses())
                                ->make();

            $customer->addresses()->saveMany($addresses);
        });

        Company::each(function ($company) {
            $addresses = Address::factory()
                                ->count(self::numberOfAddresses())
                                ->make();

            $company->addresses()->saveMany($addresses);
        });
    }

    /**
     * Get the number of addresses to create for each customer or company.
     *
     * @return int A random number between 1 and 5.
     */
    private static function numberOfAddresses(): int
    {
        return rand(1, 5);
    }
}
