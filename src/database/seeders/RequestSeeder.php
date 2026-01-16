<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Customer;
use App\Models\Company;
use App\Models\Request;

class RequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::each(function ($customer) {
            $requests = Request::factory()
                                ->count(self::numberOfRequests())
                                ->make();

            $customer->requests()->saveMany($requests);
        });

        Company::each(function ($company) {
            $requests = Request::factory()
                                ->count(self::numberOfRequests())
                                ->make();

            $company->requests()->saveMany($requests);
        });
    }

    private static function numberOfRequests(): int
    {
        return rand(1, 5);
    }
}
